<?php

namespace App\Http\Livewire\Tables;

use Exception;
use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\VendorType;
use App\Models\Subcategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;


class ProductTable extends OrderingBaseDataTableComponent
{

    public $model = Product::class;
    public bool $columnSelect = false;

    public function filters(): array
    {
        $vendorTypes = VendorType::pluck('name', 'id')->toArray();
        $category = Category::pluck('name', 'id')->toArray();
        $subCategory = Subcategory::pluck('name', 'id')->toArray();
        $brands = Brand::pluck('name', 'id')->toArray();
        return [
            'digital' => Filter::make(__("Digital"))
                ->select([
                    '' => __('Any'),
                    '1' => __('Yes'),
                    '0' => __('No'),
                ]),
            'category' => Filter::make(__("Category"))
                ->select($category),
            'sub_category' => Filter::make(__("Sub Category"))
                ->select($subCategory),
            'vendor_type' => Filter::make(__("Vendor Type"))
                ->select($vendorTypes),
            'brand' => Filter::make(__("Brand"))
                ->select($brands),
        ];
    }


    public function query()
    {

        $user = User::find(Auth::id());
        if ($user->hasRole('admin')) {
            $mQuery = Product::when($this->getFilter('digital'), fn($query, $isDigital) => $query->whereDigital($isDigital));
        } elseif ($user->hasRole('city-admin')) {
            $mQuery = Product::with('vendor')->whereHas("vendor", function ($query) {
                return $query->where('creator_id', Auth::id());
            });
        } else {
            $mQuery = Product::where("vendor_id", Auth::user()->vendor_id);
        }

        return $mQuery->withCount('options')
            ->with('vendor')
            ->latest('id')
            ->when($this->getFilter('digital'), function ($query, $isDigital) {
                return $query->whereDigital($isDigital);
            })
            ->when($this->getFilter('category'), function ($query, $category) {
                // return $query->where('category_id', $category);
                return $query->whereHas('categories', function ($query) use ($category) {
                    return $query->where('category_id', $category);
                });
            })
            ->when($this->getFilter('sub_category'), function ($query, $subCategory) {
                // return $query->where('sub_category_id', $subCategory);
                return $query->whereHas('sub_categories', function ($query) use ($subCategory) {
                    return $query->where('sub_category_id', $subCategory);
                });
            })
            ->when($this->getFilter('vendor_type'), function ($query, $vendorTypeId) {
                return $query->where('vendor_type_id', $vendorTypeId);
            })
            ->when($this->getFilter('brand'), function ($query, $brand) {
                return $query->where('brand_id', $brand);
            })
            ->when(Schema::hasColumn('products', 'approved'), function ($query) {
                return $query->where('approved', 1);
            });
    }

    public function setTableRowClass($row): ?string
    {
        return $row->is_active ? null : 'inactive-item';
    }


    public function columns(): array
    {
        return [
            $this->indexColumn(),
            $this->xsImageColumn()->addClass('w-16'),
            Column::make(__('Name'), 'name')->addClass('w-4/12 line-clamp-1 text-ellipsis truncate')->searchable(
                function ($query, $search) {
                    return $query->where('name', 'LIKE', '%' . $search . '%');
                }
            )->sortable(),
            Column::make(__('Vendor'), "vendor.name")
                ->sortable(
                    function ($query, $direction) {
                        return $query->join('vendors', 'vendors.id', '=', 'products.vendor_id')
                            ->orderBy('vendors.name', $direction);
                    }
                )
                ->searchable(
                    function ($query, $search) {
                        return $query->orWhereHas('vendor', function ($query) use ($search) {
                            return $query->where('vendors.name', 'LIKE', '%' . $search . '%');
                        });
                    }
                ),
            // Column::make(__('Price'), 'price')->format(function ($value, $column, $row) {
            //     if ($row->discount_price) {
            //         $text = "<span class='font-medium'>" . currencyFormat($row->discount_price ??  '') . "</span>";
            //         $text .= " <span class='text-xs line-through'>" . currencyFormat($row->price) . "</span>";
            //     } else {
            //         $text = currencyFormat($value ??  '');
            //     }
            //     return view('components.table.plain', $data = [
            //         "text" => $text
            //     ]);
            // })->searchable()->sortable(),
            Column::make(__('Price'))->format(function ($value, $column, $row) {

                $original  = floatval($row->price);
                $final     = floatval($row->final_price);
                $vendor    = $row->vendor ?? null;

                $hasProductDiscount = (!empty($row->discount_price) && $row->discount_price > 0);
                $vendorActive       = ($vendor && $vendor->discount_active);

                $discountType  = null;
                $discountLabel = '';
                $youSave       = 0;

                // ────────────────────────────────────────────
                // CASE 1 — Product-level discount
                // ────────────────────────────────────────────
                if ($hasProductDiscount) {
                    $discountType  = 'product';
                    $youSave       = $original - floatval($row->discount_price);
                    $discountLabel = "Product Discount";
                    $final         = floatval($row->discount_price);
                }

                // ────────────────────────────────────────────
                // CASE 2 — Vendor-level discount
                // ────────────────────────────────────────────
                elseif ($vendorActive && $final < $original) {
                    $discountType = $vendor->discount_type;

                    if ($discountType === 'percent') {
                        $youSave       = ($original * $vendor->discount_value) / 100;
                        $discountLabel = "{$vendor->discount_value}% Vendor Discount";
                    } else {
                        $youSave       = floatval($vendor->discount_value);
                        $discountLabel = currencyFormat($vendor->discount_value) . " Vendor Discount";
                    }
                }

                $youSave = round($youSave, 2);

                // ────────────────────────────────────────────
                // HTML BUILD
                // ────────────────────────────────────────────
                $html = "<div class='flex flex-col'>";

                // FINAL PRICE + ORIGINAL PRICE
                if ($final < $original) {
                    $html .= "
            <span class='font-semibold text-base text-green-700'>
                " . currencyFormat($final) . "
            </span>
            <span class='text-xs line-through text-gray-500'>
                " . currencyFormat($original) . "
            </span>
        ";
                } else {
                    $html .= "<span class='font-semibold'>" . currencyFormat($original) . "</span>";
                }

                // DISCOUNT LABEL
                if ($discountType) {
                    $html .= "
            <span class='text-xs text-blue-700 mt-1'>
                <strong>{$discountLabel}</strong>
            </span>
        ";
                }

                // YOU SAVE
                if ($youSave > 0) {
                    $html .= "
            <span class='text-xs text-purple-600 font-semibold'>
                You save: " . currencyFormat($youSave) . "
            </span>
        ";
                }

                $html .= "</div>";

                return view('components.table.plain', ["text" => $html]);
            })
                ->sortable()
                ->searchable(),



            Column::make(__('Qty'), "available_qty")->format(function ($value, $column, $row) {
                if ($value == null) {
                    return __("Unlimited");
                } else {
                    return $value;
                }
                // return view('components.table.plain', $data = [
                //     "text" => $text
                // ]);
            })->sortable()->addClass('w-32'),

            // Column::make(__('Has Options'), 'has_options')->format(function ($value, $column, $row) {
            //     if ($value) {
            //         return view('components.table.check');
            //     } else {
            //         return view('components.table.close');
            //     }
            // })->sortable(function ($query, $direction) {
            //     return $query->orderBy('options_count', $direction);
            // }),
            Column::make(__('Feature Product'))->format(function ($value, $column, $row) {
                return view('components.toggle', ['model' => $row, 'field' => 'feature_status']);
            }),
            Column::make(__('Actions'))->addClass('flex items-center')->format(function ($value, $column, $row) {
                return view('components.buttons.product_actions', $data = [
                    "model" => $row
                ]);
            }),
        ];
    }


    //
    public function deleteModel()
    {

        try {
            $this->isDemo();
            DB::beginTransaction();
            $this->selectedModel->delete();
            DB::commit();
            $this->showSuccessAlert("Deleted");
        } catch (Exception $error) {
            DB::rollback();
            $this->showErrorAlert($error->getMessage() ?? "Failed");
        }
    }

    public function toggleStatus($id, $field)
    {
        $product = Product::find($id);
        if ($product) {
            $product->{$field} = !$product->{$field};
            $product->save();
            $this->emit('refreshTable');
            session()->flash('message', __('Sales Products status updated successfully.'));
        } else {
            session()->flash('error', __('Sales Products not found.'));
        }
    }
}
