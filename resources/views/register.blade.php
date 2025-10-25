@extends('layout.app')

@section('content')
    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-2 text-center">Pendaftaran</h2>
            <p class="text-gray-600 text-center mb-8">Buat akun baru untuk memulai</p>

            <form class="space-y-5" action="{{ route('register.post') }}" method="POST">
                <!-- CSRF Token -->
                @csrf
                <!-- Nama Lengkap -->
                <div>
                    <label for="nama" class="block text-gray-700 font-medium mb-2">Nama Lengkap</label>
                    <input type="text" id="nama" name="name" placeholder="Masukkan nama lengkap" value="{{ old('name') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                        required>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                    <input type="email" id="email" name="email" placeholder="Masukkan email" value="{{ old('email') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                        required>
                </div>

                <!-- NIM/NPM -->
                <div>
                    <label for="nim" class="block text-gray-700 font-medium mb-2">NIM/NPM</label>
                    <input type="text" id="nim" name="nim" placeholder="Masukkan NIM/NPM" value="{{ old('nim') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                        required>
                </div>

                <div>
                    <label for="jenis_kelamin" class="block text-gray-700 font-medium mb-2">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                        required>
                        @foreach(['L' => 'Laki-laki', 'P' => 'Perempuan'] as $value => $label)
                            <option value="{{ $value }}" {{ old('jenis_kelamin') === $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="prodi" class="block text-gray-700 font-medium mb-2">Pilih Prodi</label>
                    <select id="prodi" name="prodi_id"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                        required>
                        @foreach($prodis as $prodi)
                            <option value="{{ $prodi->id }}" {{ old('prodi_id') == $prodi->id ? 'selected' : '' }}>
                                {{ $prodi->nama_prodi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                        required>
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label for="password-confirm" class="block text-gray-700 font-medium mb-2">Konfirmasi
                        Password</label>
                    <input type="password" id="password-confirm" name="password_confirmation" placeholder="Ulangi password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                        required>
                </div>

                <!-- Tombol Daftar -->
                <button type="submit"
                    class="w-full bg-blue-600 text-white font-medium py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                    Daftar
                </button>
            </form>

            <!-- Link Login -->
            <p class="text-center text-gray-600 mt-6">
                Sudah memiliki akun?
                <a href="{{ route('login') }}" class="text-blue-600 font-medium hover:text-blue-700 transition">Login di
                    sini</a>
            </p>
        </div>
    </div>

    {{-- alernt plugin --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                customClass: {
                    popup: 'glass-popup rounded-3xl shadow-blur p-6',
                    title: 'font-semibold',
                    icon: 'icon-custom bg-transparent'
                },
                timer: 2000
            });
        @endif

        @if($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                customClass: {
                    popup: 'glass-popup rounded-3xl shadow-blur p-6',
                    title: 'font-bold',
                    confirmButton: 'button-confirm px-6 py-2 rounded-xl text-white',
                }
            });
        @endif
    </script>
@endsection