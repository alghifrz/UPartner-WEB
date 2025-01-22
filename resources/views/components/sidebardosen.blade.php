<div class="w-1/5 bg-background h-screen mb-0 top-0 p-4 ">
    <div class="text-center mb-6">
        <h3 class="mt-4 font-bold mb-8 text-3xl text-primary pb-6 border-b-2 border-gray-200">Proyek Saya</h3>
    </div>

    <ul class="space-y-4">
        <li>
            <a href="{{ route('dosen.proyek') }}" 
               class="rounded-xl py-4 px-12 flex items-center text-xl gap-3 font-semibold
               {{ Request::is('dosen/proyek') ? 'text-primary bg-white  border border-gray-100 shadow-md' : 'text-gray-400  hover:shadow-md hover:rounded-xl hover:border hover:border-gray-100' }}">
               <i class="fas fa-line-chart pl-1 {{ Request::is('dosen/proyek') ? 'text-tertiary' : 'text-gray-400' }}"></i>
                Statistik Saya
            </a>
        </li>
        <li>
            <a href="{{ route('dosen.proyeksaya') }}" 
               class="rounded-xl py-4 px-12 flex items-center text-xl gap-3 font-semibold 
               {{ Request::is('dosen/proyek/proyek-saya') ? 'text-primary bg-white border border-gray-100 shadow-md' : 'text-gray-400  hover:shadow-md hover:rounded-xl hover:border hover:border-gray-100' }}">
                <i class="fas fa-book px-1 {{ Request::is('dosen/proyek/proyek-saya') ? 'text-tertiary' : 'text-gray-400' }}"></i> 
                Proyek Saya
            </a>
        </li>
        <li>
            <a href="{{ route('dosen.pendaftaranproyek') }}" 
               class="rounded-xl py-4 px-12 flex items-center text-xl gap-3 font-semibold 
               {{ Request::is('dosen/proyek/pendaftaran-proyek') ? 'text-primary bg-white border border-gray-100 shadow-md pr-2' : 'text-gray-400  hover:shadow-md hover:rounded-xl hover:border hover:border-gray-100' }}">
               <i class="fas fa-clipboard-list px-1 {{ Request::is('dosen/proyek/pendaftaran-proyek') ? 'text-tertiary' : 'text-gray-400' }}"></i> 
                Pendaftaran Proyek
            </a>
        </li>
        <li>
            <a href="{{ route('dosen.kelolaproyek') }}" 
               class="rounded-xl py-4 px-12 flex items-center text-xl gap-3 font-semibold 
               {{ Request::is('dosen/proyek/kelola-proyek') || Request::is('dosen/proyek/kelola-proyek/*') ? 'text-primary bg-white border border-gray-100 shadow-md pr-2' : 'text-gray-400  hover:shadow-md hover:rounded-xl hover:border hover:border-gray-100' }}">
               <i class="fas fa-project-diagram text-center {{ Request::is('dosen/proyek/kelola-proyek') || Request::is('dosen/proyek/kelola-proyek/*') ? 'text-tertiary' : 'text-gray-400' }}"></i> 
                Kelola Proyek
            </a>
        </li>
        <li>
            <a href="{{ route('dosen.kelolaiklan') }}" 
               class="rounded-xl py-4 px-12 flex items-center text-xl gap-3 font-semibold 
               {{ Request::is('dosen/proyek/kelola-iklan') ? 'text-primary bg-white  border border-gray-100 shadow-md pr-2' : 'text-gray-400  hover:shadow-md hover:rounded-xl hover:border hover:border-gray-100' }}">
               <i class="fas fa-ad {{ Request::is('dosen/proyek/kelola-iklan') ? 'text-tertiary' : 'text-gray-400' }}"></i> 
                Kelola Iklan
            </a>
        </li>
    </ul>
</div>
