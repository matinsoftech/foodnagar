<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone Verification Form</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .verification-container {
            background: #fff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }

        .verification-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .verification-container label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-size: 14px;
            text-align: left;
        }

        .verification-container input[type="text"],
        .verification-container input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        .verification-container button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .verification-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="verification-container">
        <h2>Phone Verification</h2>
        <form>
            <input type="text" id="user_id" name="user_id" placeholder="Enter your phone number" value="{{ $user->id }}" hidden>

            <label for="otp">Enter OTP you have received</label>
            <input type="number" id="otp" name="otp" placeholder="Enter OTP" required>
            <span id="message"></span>

            <button type="submit">Verify</button>
        </form>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $('form').submit(function(e) {
            e.preventDefault();

            var user_id = $('#user_id').val();
            var otp = $('#otp').val();

            $.ajax({
                url: '/auth-verify-phone',
                type: 'POST',
                data: {
                    _token : '{{ csrf_token() }}',
                    user_id: user_id,
                    otp: otp
                },
                success: function(response) {
                    if(response.success == true) {
                        // alert(response.message);
                        toastr.success(response.message);
                        setTimeout(() => {
                            window.location.href = '{{ url("/") }}';
                        }, 3000);
                    }else{
                        $('#message').text(response.message);
                        toastr.error(response.message);
                    }
                },
                error: function(xhr) {
                    alert(xhr.responseJSON.message);
                }
            });
        });
    });
</script>
</html>
