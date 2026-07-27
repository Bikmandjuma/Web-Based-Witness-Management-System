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
                Wibagiwe umubare-banga
            </h2>

            <form action="{{ route('guest.submit-forgot-password') }}" method="POST">
                @csrf

                <!-- EMAIL -->
                <div style="margin-bottom:16px;">
                    <label for="email" style="display:block;font-weight:700;margin-bottom:6px;">
                        Imeyili
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Andika imeyili yawe"
                        style="width:100%;padding:12px 16px;border-radius:999px;border:1px solid #ccc;outline:none;font-size:14px;"
                    >

                    @error('email')
                        <small style="color:red;display:block;margin-top:6px;">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <button type="submit"
                    style="width:100%;padding:14px 0;background:var(--gold);color:var(--green-dark);
                    border:none;border-radius:999px;font-weight:700;font-size:16px;cursor:pointer;">
                    Ohereza emeyili
                </button>

                <div style="display:flex;justify-content:center;align-items:center;margin-top:20px;font-size:13px;">
                    <a href="{{ route('owner.login') }}" style="color:var(--green);font-weight:700;">
                        <i class="fas fa-arrow-left"></i> Fungura
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
</script>

@endsection