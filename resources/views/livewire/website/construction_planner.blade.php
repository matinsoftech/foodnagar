@extends('livewire.website.layouts.app')

@section('content')

<img src="{{ asset('css/assets/images/nepali_avatar.jpg') }}" alt="Avatar" 
class="d-none d-lg-block"
style="position: absolute; top: 50%;left: 0;height: 60%; mix-blend-mode: multiply;">
<div class="container row mx-auto" style="margin: 0 5rem 5rem 5rem;">
    <div class="col-lg-12 p-2 d-flex" style="align-items: center; justify-content: center;">
        <lottie-player src="https://lottie.host/2448d3bc-3b91-430f-9fd3-f89983df8e2b/55UZ9ntYGm.json" 
    background="##FFFFFF" speed="1" style="width: 300px; height: 200px" 
    loop autoplay direction="1" mode="normal"></lottie-player>
    </div>
    

    <div class="col-lg-5 offset-lg-2 p-2">

            <div class="card text-dark fs-2 rounded p-2 d-grid align-items-center justify-content-center shadow-sm position-relative overflow-hidden"
            style="background-color: #e9ecef; height: 10rem; cursor: pointer;">
            <span class="card-text position-relative" style="z-index: 1;">म श्रमिकहरू भर्ना गर्न चाहन्छु</span>
            <div class="slide-bg"></div>
        </div>
    </div>
    
    <div class="col-lg-5 p-2">
        <a href="{{ route('ad-listing') }}">

            <div class="card text-dark fs-2 rounded p-2 d-grid align-items-center justify-content-center shadow-sm position-relative overflow-hidden"
            style="background-color: #e9ecef; height: 10rem; cursor: pointer;">
            <span class="card-text position-relative" style="z-index: 1;">म मेरो सम्पत्ति बेच्न चाहन्छु</span>
            <div class="slide-bg"></div>
        </div>
    </a>
    </div>
    
    <div class="col-lg-5 offset-lg-2 p-2">
        <div class="card text-dark fs-2 rounded p-2 d-grid align-items-center justify-content-center shadow-sm position-relative overflow-hidden"
             style="background-color: #e9ecef; height: 10rem; cursor: pointer;">
            <span class="card-text position-relative" style="z-index: 1;">म लागत अनुमान गर्न चाहन्छु</span>
            <div class="slide-bg"></div>
        </div>
    </div>
    
    <div class="col-lg-5 p-2">
        <div class="card text-dark fs-2 rounded p-2 d-grid align-items-center justify-content-center shadow-sm position-relative overflow-hidden"
             style="background-color: #e9ecef; height: 10rem; cursor: pointer;">
            <span class="card-text position-relative" style="z-index: 1;">म निर्माणका लागि कच्चा सामग्री किन्न चाहन्छु</span>
            <div class="slide-bg"></div>
        </div>
    </div>
    
    <div class="col-lg-5 offset-lg-2 p-2">
        <div class="card text-dark fs-2 rounded p-2 d-grid align-items-center justify-content-center shadow-sm position-relative overflow-hidden"
             style="background-color: #e9ecef; height: 10rem; cursor: pointer;">
            <span class="card-text position-relative" style="z-index: 1;">म ठेकेदारको खोजीमा छु</span>
            <div class="slide-bg"></div>
        </div>
    </div>
    
    <div class="col-lg-5 p-2" id="modal-btn">
        <div class="card text-dark fs-2 rounded p-2 d-grid align-items-center justify-content-center shadow-sm position-relative overflow-hidden"
             style="background-color: #e9ecef; height: 10rem; cursor: pointer;">
            <span class="card-text position-relative" style="z-index: 1;">मेरो प्रश्न यहाँ छैन, म अझ बुझ्न चाहन्छु।</span>
            <div class="slide-bg"></div>
        </div>
    </div>    

    <!-- Modal Dialog -->
    <dialog id="modalForm" style="padding: 20px; border: none; border-radius: 8px; margin: auto; width: 35rem;">
        <form action="" class="d-flex flex-column gap-4">
            <input type="text" placeholder="Enter your Name" class="form-control form-control-lg rounded-3 p-3">
            <input type="number" placeholder="Enter your Phone Number" class="form-control form-control-lg rounded-3 p-3">
            <textarea cols="8" rows="8" placeholder="Enter our Message"
                class="form-control form-control-lg rounded-3 p-3"></textarea>
            <div style="display: flex; align-items: center; width: 100%; gap: 20px;">
                <button type="submit" class="btn btn-primary py-2" style="width: max-content;">
                    Send Message
                </button>
                <button id="close-btn" class="btn btn-primary w-25 py-2">
                    Cancel
                </button>
            </div>
        </form>
    </dialog>





</div>

@endsection

@section('js')
<script src="https://unpkg.com/@lottiefiles/lottie-player@2.0.8/dist/lottie-player.js"></script>

<!-- JavaScript to handle the modal -->
<script>
    // Get the modal and button elements
        const modal = document.getElementById('modalForm');
        const modalBtn = document.getElementById('modal-btn');
        const closeBtn = document.getElementById('close-btn');
    
        // Open the modal when the div is clicked
        modalBtn.addEventListener('click', function () {
            modal.showModal();  // Open the dialog modal
        });
    
        // Close the modal when the close button is clicked
        closeBtn.addEventListener('click', function (e) {
            e.preventDefault();
            modal.close();  // Close the dialog modal
        });

        // Close the modal if clicked outside of the modal content
        modal.addEventListener('click', function (e) {
        // Check if the click target is the modal background (not the form inside)
        if (e.target === modal) {
            modal.close();  // Close the dialog modal if clicked outside
        }
    });
</script>
@endsection

@section('css')
<style>
    #modalForm::backdrop{
        background-color: rgba(0, 0, 0, 0.7);
    }

    .card {
    position: relative;
    overflow: hidden;
    transition: color 0.3s ease;
}


.slide-bg {
    position: absolute;
    top: 0;
    left: -100%; 
    width: 100%;
    height: 100%;
    background-color: #db3030; 
    transition: left 0.3s ease; 
    z-index: 0;
}


.card:hover .slide-bg {
    left: 0;
}


.card:hover .card-text {
    color: white; 
}
    </style>
@endsection