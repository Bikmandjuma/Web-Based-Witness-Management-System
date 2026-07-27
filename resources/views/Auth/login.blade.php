@extends('Auth.cover')
@section('content')

<section class="section" id="login">

    @if(session('success'))
        <script>
            toastr.success("{{ session('success') }}", "Success");
        </script>
    @endif

    @if(session('error'))
        <script>
            toastr.error("{{ session('error') }}", "Error");
        </script>
    @endif

    <div class="container" style="max-width:400px;">

        <div style="background:white;padding:36px;border-radius:var(--radius);box-shadow:var(--shadow);border-top:5px solid var(--gold);">

            <h2 style="text-align:center;font-family:'Playfair Display',serif;color:var(--green-dark);margin-bottom:20px;">
                Injira mu rubuga
            </h2>

            <form action="{{ route('owner.submit.login') }}" method="POST" onsubmit="showLoader()">
                @csrf

                <!-- EMAIL -->
                <div style="margin-bottom:16px;">
                    <label for="email" style="display:block;font-weight:700;margin-bottom:6px;">
                        Imeyili
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="username"
                        value="{{ old('username') }}"
                        placeholder="Andika imeyili yawe cga nimero ya telefone"
                        style="width:100%;padding:12px 16px;border-radius:999px;border:1px solid #ccc;outline:none;font-size:14px;"
                    >

                    @error('username')
                        <small style="color:red;display:block;margin-top:6px;">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <!-- PASSWORD -->
                <div style="margin-bottom:16px;">
                    <label for="password" style="display:block;font-weight:700;margin-bottom:6px;">
                        Umubare banga
                    </label>

                    <div style="position:relative;">

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Andika umubare banga wawe"
                            style="width:100%;padding:12px 45px 12px 16px;border-radius:999px;border:1px solid #ccc;outline:none;font-size:14px;"
                        >

                        <span
                            onclick="togglePassword()"
                            style="position:absolute;right:16px;top:50%;transform:translateY(-50%);cursor:pointer;color:#777;"
                        >
                            <i id="eyeIcon" class="fa fa-eye"></i>
                        </span>

                    </div>

                    @error('password')
                        <small style="color:red;display:block;margin-top:6px;">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <!-- LOGIN BUTTON -->
                <button type="submit" id="loginBtn"
                    style="width:100%;padding:14px 0;background:var(--gold);color:var(--green-dark);
                    border:none;border-radius:999px;font-weight:700;font-size:16px;cursor:pointer;">

                    <span id="btnText">Fungura</span>
                    <span id="btnLoader" style="display:none;">
                        <i class="fa fa-spinner fa-spin"></i> Turimo kwinjira...
                    </span>

                </button>

                <div style="display:flex;justify-content:center;align-items:center;margin-top:20px;font-size:13px;">
                    <a href="{{ route('guest.forgot-password') }}" style="color:var(--green);font-weight:700;">
                        Wibagiwe umubare-banga?
                    </a>
                </div>

            </form>

        </div>

    </div>

</section>

<script>
function togglePassword() {
    const password = document.getElementById("password");
    const eyeIcon = document.getElementById("eyeIcon");

    if (password.type === "password") {
        password.type = "text";
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
    } else {
        password.type = "password";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
    }
}

function showLoader() {
    document.getElementById("btnText").style.display = "none";
    document.getElementById("btnLoader").style.display = "inline";
    document.getElementById("loginBtn").disabled = true;
}
</script>

@endsection