<img class="absolute h-full top-0 w-full z-0" src="/img/bg.png" alt="Your Company">
<div class="min-h-full z-20">
<x-dosen-app-layout :title="$header" :footer="$footer">
        
        <div class="relative">
            <div class="lg:mt-32 mt-20 lg:mx-24 mx-4 lg:relative opacity-0 data-animate overflow-hidden mb-16" data-animation="slide-up">
                <div class="lg:p-12 p-4 lg:px-16 mx-4 text-center lg:text-left lg:absolute lg:top-0 lg:right-40 z-20 bg-muda lg:max-w-4xl rounded-t-3xl lg:rounded-3xl opacity-0 data-animate" data-animation="slide-up">
                    <p class="font-semibold lg:text-lg text-lg mb-4 tracking-widest text-black">{{ $tentang ['judul']}}</p>
                    <p class="font-semibold xl:text-4xl lg:text-2xl md:text-2xl text-xl leading-snug text-primary">{{ $tentang ['deskripsi']}}</p>
                </div>
                <div class="p-12 lg:absolute lg:bottom-0 mx-4 lg:right-40 rounded-b-3xl lg:rounded-none z-20 bg-primary lg:max-w-4xl opacity-0 data-animate" data-animation="slide-up">
                    <div class="flex justify-around gap-16">
                        @foreach ($tentang['insight'] as $insight)
                            <div class="text-center">
                                <p class="font-extrabold xl:text-6xl lg:text-4xl text-3xl mb-4 text-white">{{ $insight['value'] }}</p>
                                <p class="font-regular text-sm md:text-xl mb-4 text-white">{{ $insight['label']}}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <img src="{{ $tentang ['foto'] }}" alt="foto" class="hidden lg:block lg:pt-40 z-10 lg:w-full rounded-t-3xl hover:cursor-pointer hover:scale-105 hover:duration-500 hover:rounded-3xl hover:ease-in-out">
            </div>
             <div class="mt-0 mx-8 lg:mx-24 p-6 lg:p-24 py-12 bg-white text-secondary rounded-bl-3xl rounded-br-2xl opacity-0 data-animate" 
                    data-animation="slide-up">
                <div class="flex flex-col 2xl:flex-row 2xl:gap-40 gap-20 opacity-0 data-animate" data-animation="slide-up">
                    <div class="2xl:w-1/2 flex flex-col">
                    <p class="font-semibold text-lg mb-4 tracking-widest">{{ $tentang['visi']['judul'] }}</p>
                    <p class="font-semibold text-2xl mb-4 leading-snug">{{ $tentang['visi']['detail'] }}</p>
                      <!-- {{-- <p class="mb-8 text-abu">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex deleniti, temporibus quos dicta ad, voluptatem quae corporis sint nemo vero saepe aut. Consequatur deleniti facere fuga nemo pariatur recusandae esse.</p> --}} -->
                    </div>
                    <div class="flex flex-col opacity-0 data-animate" data-animation="slide-up">
                        <p class="font-semibold text-lg mb-4 tracking-widest text-abu">{{ $tentang['misi']['judul'] }}</p>
                        @foreach ($tentang['misi']['detail'] as $misi)
                            <p class="font-semibold text-2xl mb-8 text-abu">{{ $misi['detail'] }}</p>
                        @endforeach
                    <!-- {{-- <p class="font-semibold text-2xl mb-4 leading-snug">Menjadi platform informasi bola terbaik seputar Real Madrid</p>
                    <p class="mb-8 text-abu">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex deleniti, temporibus quos dicta ad, voluptatem quae corporis sint nemo vero saepe aut. Consequatur deleniti facere fuga nemo pariatur recusandae esse.</p> --}} -->
                  </div>
                </div>
              </div>
              <!-- {{-- <div class="mt-32 mx-24">
                <div class="flex justify-between items-center">
                    <div class="mb-4 max-w-2xl">
                        <h3 class="text-4xl mb-4 font-bold">Our team of creatives</h3>
                        <h3 class="text-xl mb-4 font-bold">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</h3>
                        <p class="mb-8 text-abu">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex deleniti, temporibus quos dicta ad, voluptatem quae corporis sint nemo vero saepe aut. Consequatur deleniti facere fuga nemo pariatur recusandae esse.</p>
                    </div>
                    <div class="py-24 p-16 absolute left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10 bg-biru max-w-xl rounded-tl-3xl"></div>
                    <img src="https://cdn.vox-cdn.com/thumbor/yZ402Glg6urup549KSDyW582teU=/0x0:4724x3150/1200x0/filters:focal(0x0:4724x3150):no_upscale()/cdn.vox-cdn.com/uploads/chorus_asset/file/20038440/1209751767.jpg.jpg" alt="" class="w-1/2 rounded-2xl transition-transform duration-500 ease-in-out hover:scale-110">
                </div>
              </div>
              <div class="mt-32 mx-24">
                <div class="flex justify-between items-center">
                    <div class="py-16 p-16 absolute left-1/2 transform -translate-x-1/2 -translate-y-1/10 z-10 bg-gelap max-w-xl rounded-full"></div>
                    <img src="https://estaticos-cdn.prensaiberica.es/clip/2ca11dfd-655f-46f6-aa53-e2b8750af3f0_original-libre-aspect-ratio_default_0.jpg" alt="" class="w-1/2 rounded-2xl">
                    <div class="mb-4 max-w-2xl">
                        <h3 class="text-4xl mb-4 font-bold">Why we started this Blog?</h3>
                        <h3 class="text-xl mb-4 font-bold">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</h3>
                        <p class="mb-8 text-abu">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex deleniti, temporibus quos dicta ad, voluptatem quae corporis sint nemo vero saepe aut. Consequatur deleniti facere fuga nemo pariatur recusandae esse.</p>
                    </div>
                </div>
              </div> --}} -->

              <div class="mt-32 mb-56 mx-4 lg:mx-64">
                <h3 class="text-5xl font-bold mb-24 2xl:mb-24 text-center text-secondary opacity-0 data-animate" 
                    data-animation="slide-up">
                    {{ $tentang['tim']['judul'] }}
                </h3>
                <div class="flex flex-wrap justify-center gap-24">
                    @foreach ($tentang['tim']['detail'] as $tim)
                        @php
                            $orderClasses = [
                                '105222006' => 'order-first 2xl:order-none',
                                '105222003' => 'order-1 2xl:order-none',
                                '105222031' => 'order-2 2xl:order-none',
                                '105222034' => 'order-3 2xl:order-none',
                            ];
                        @endphp
                        <div class="opacity-0 data-animate {{ $orderClasses[$tim['nim']] ?? '' }}" data-animation="slide-up">
                            <x-cardauthor :tim="$tim" />
                        </div>
                    @endforeach
                </div>
                
            </div>

              <x-ajakan>{{ $tentang['ajak'] }}</x-ajakan>
                          
           
        </div>
        
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const animation = entry.target.getAttribute('data-animation');
                        entry.target.classList.add(animation);
                        entry.target.style.opacity = '1';
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.data-animate').forEach((element) => {
                observer.observe(element);
            });
        });
    </script>

</x-app-layout>