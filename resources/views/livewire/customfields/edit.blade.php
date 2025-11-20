@extends('layouts.app')
@section('title', __('Update Custom Field'))
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default{
        width: 100% !important;
    }
</style>
@endsection
@section('content')
<x-baseview title="{{ __('Update Custom Field') }}" >
    <div class="overflow-x-auto">
        <div class="container mx-auto py-6">
            <div class="bg-white shadow-md rounded-lg p-6">
                <form action="{{ route('custom-fields.update', $customField->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Vendor Types</label>
                        <select name="vendortype[]" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm select2" multiple>
                            <option value="" disabled>Select Module</option>
                            @foreach ($vendorTypes as $vendorType)
                                <option @if(in_array($vendorType->id, $selectedVendorTypes))  selected @endif value="{{ $vendorType->id }}">{{ $vendorType->slug }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                            placeholder="Field Name" value="{{ $customField->name }}">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Type</label>
                        <select id="type" name="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" id="type" data-parsley-required="true">
                            <option @if($customField->type == 'number') selected @endif value="number">{{__("Number Input")}}</option>
                            <option @if($customField->type == 'textbox') selected @endif value="textbox">{{__("Text Input")}}</option>
                            <option @if($customField->type == 'textarea') selected @endif value="textarea">{{__("Text Area")}}</option>
                            <option @if($customField->type == 'fileinput') selected @endif value="fileinput">{{__("File Input")}}</option>
                            <option @if($customField->type == 'radio') selected @endif value="radio">{{__("Radio")}}</option>
                            <option @if($customField->type == 'dropdown') selected @endif value="dropdown">{{__("Dropdown")}}</option>
                            <option @if($customField->type == 'checkbox') selected @endif value="checkbox">{{__("Checkboxes")}}</option>
                        </select>
                    </div>

                    <div class="mb-4" id="values_field" @if($customField->type == 'number' || $customField->type == 'textbox' || $customField->type == 'fileinput') style="display: none;" @endif>
                        <label class="block text-sm font-medium text-gray-700">Field Values</label>
                        <select type="text" name="values[]" class="select2-tags mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                            data-tags="true" data-token-separators="[',']" data-placeholder="{{__("Select an option")}}" data-allow-clear="true" class="select2 w-100 full-width-select2" multiple="multiple" data-parsley-required="true">
                            @if($customField->type == 'radio' || $customField->type == 'dropdown' || $customField->type == 'checkbox')
                                @foreach($customField->values as $value)
                                    <option value="{{ $value }}" selected>{{ $value }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    {{-- min_length --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Min Length</label>
                        <input type="number" name="min_length" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                            placeholder="Min Length" value="{{ $customField->min_length }}">
                    </div>

                    {{-- max_length --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Max Length</label>
                        <input type="number" name="max_length" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                            placeholder="Max Length" value="{{ $customField->max_length }}">
                    </div>



                    <!-- Image Upload Input (optional) -->
                    <div class="mb-4">
                        @if($customField->image)
                            <img src="{{ asset('storage/'.$customField->image) }}" alt="" width="50" height="50">
                        @endif
                        <label class="block text-sm font-medium text-gray-700">Upload Icon</label>
                        <input type="file" name="image" accept="image/*"
                            class="mt-1 block w-full text-sm text-gray-500 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>

                    {{-- required --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Required</label>
                        <select name="required" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                            <option @if($customField->required == 1) selected @endif value="1">Yes</option>
                            <option @if($customField->required == 0) selected @endif value="0">No</option>
                        </select>
                    </div>

                    <!-- Published Checkbox -->
                    <div class="mb-4">
                        <label class="inline-flex items-center text-sm font-medium text-gray-700">
                            <input type="checkbox" name="is_active"
                                class="form-checkbox text-blue-500 focus:ring-blue-500" @if($customField->is_active == 1) checked @endif>
                            <span class="ml-2">Active</span>
                        </label>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end mt-4">
                        <a href="{{ route('custom-fields.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                            Cancel
                        </a>
                        <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Save Custom Field
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-baseview>
@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
        $('.select2-tags').select2({
            tags: true
        });

        $('#type').on('change',function(){
            var type = $(this).val();
            if(type == 'radio' || type == 'dropdown' || type == 'checkbox'){
                $('#values_field').show();
            }else{
                $('#values_field').hide();
            }
        });        
    });
</script>
@endpush