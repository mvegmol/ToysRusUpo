<div class="bg-primary text-white py-3 flex justify-center items-center cursor-pointer hover:bg-tertiary transition-colors duration-300 mt-40" onclick="window.scrollTo({top: 0, behavior: 'smooth'});">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 hover:scale-125 transition-transform duration-300">
        <path stroke-linecap="round" stroke-linejoin="round" d="m15 11.25-3-3m0 0-3 3m3-3v7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
    </svg>
</div>

<div class="bg-secondary text-gray-600 pt-6 px-20"> <!-- Aumentar la separación del footer -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mt-8">
        <!-- About Us -->
        <div class="text-center">
            <h4 class="font-bold mb-4 text-primary text-xl border-b-2 border-primary pb-2 uppercase">About Us</h4>
            <ul>
                <li><a href="#" class="hover:text-primary">Our Story</a></li>
                <li><a href="#" class="hover:text-primary">Careers</a></li>
                <li><a href="#" class="hover:text-primary">Sustainability</a></li>
            </ul>
        </div>
        <!-- Customer Service -->
        <div class="text-center">
            <h4 class="font-bold mb-4 text-primary text-xl border-b-2 border-primary pb-2 uppercase">Customer Service</h4>
            <ul>
                <li><a href="#" class="hover:text-primary">Contact Us</a></li>
                <li><a href="#" class="hover:text-primary">Shipping Policy</a></li>
                <li><a href="#" class="hover:text-primary">Returns</a></li>
            </ul>
        </div>
        <!-- Shop -->
        <div class="text-center">
            <h4 class="font-bold mb-4 text-primary text-xl border-b-2 border-primary pb-2 uppercase">Shop</h4>
            <ul>
                <li><a href="#" class="hover:text-primary">Best Sellers</a></li>
                <li><a href="#" class="hover:text-primary">New Arrivals</a></li>
                <li><a href="#" class="hover:text-primary">Gift Cards</a></li>
            </ul>
        </div>
        <!-- Information -->
        <div class="text-center">
            <h4 class="font-bold mb-4 text-primary text-xl border-b-2 border-primary pb-2 uppercase">Information</h4>
            <ul>
                <li><a href="#" class="hover:text-primary">FAQ</a></li>
                <li><a href="#" class="hover:text-primary">Terms of Service</a></li>
                <li><a href="#" class="hover:text-primary">Privacy Policy</a></li>
            </ul>
        </div>
    </div>

    <div class="grid grid-cols-5 gap-0 mt-10 mb-5"> <!-- Ajustar el espacio entre las columnas -->
        <!-- Phone Information -->
        <div class="col-span-2 flex flex-col items-center justify-center">
            <p class="text-center mb-4">If you have any suggestions or questions, we are happy to help!</p>
            <div class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                </svg>
                <span>+1 234 567 890</span>
            </div>
        </div>
        <!-- Logo -->
        <div class="col-span-1 flex flex-col items-center mx-auto w-36">
            <a href="javascript:void(0)" class="mb-4">
                <img src="{{ asset('images/icons/toysrusupo.png') }}" alt="logo" class='w-36' />
            </a>
        </div>        
        <!-- Redes Sociales -->
        <div class="col-span-2 flex flex-col items-center justify-center">
            <h4 class="font-bold mb-4 text-primary text-xl uppercase mb-4">Síguenos</h4>
            <div class="flex justify-center space-x-8">
                <a href="https://www.youtube.com" target="_blank">
                    <svg fill="currentColor" width="40px" height="40px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-primary hover:text-tertiary transition-colors duration-300">
                        <path d="M24.325 8.309s-2.655-.334-8.357-.334c-5.517 0-8.294.334-8.294.334A2.675 2.675 0 0 0 5 10.984v10.034a2.675 2.675 0 0 0 2.674 2.676s2.582.332 8.294.332c5.709 0 8.357-.332 8.357-.332A2.673 2.673 0 0 0 27 21.018V10.982a2.673 2.673 0 0 0-2.675-2.673zM13.061 19.975V12.03L20.195 16l-7.134 3.975z"/>
                    </svg>
                </a>
                <a href="https://www.facebook.com" target="_blank">
                    <svg fill="currentColor" width="40px" height="40px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-primary hover:text-tertiary transition-colors duration-300">
                        <path d="M20 12.05C19.9813 10.5255 19.5273 9.03809 18.6915 7.76295C17.8557 6.48781 16.673 5.47804 15.2826 4.85257C13.8921 4.2271 12.3519 4.01198 10.8433 4.23253C9.33473 4.45309 7.92057 5.10013 6.7674 6.09748C5.61422 7.09482 4.77005 8.40092 4.3343 9.86195C3.89856 11.323 3.88938 12.8781 4.30786 14.3442C4.72634 15.8103 5.55504 17.1262 6.69637 18.1371C7.83769 19.148 9.24412 19.8117 10.75 20.05V14.38H8.75001V12.05H10.75V10.28C10.7037 9.86846 10.7483 9.45175 10.8807 9.05931C11.0131 8.66687 11.23 8.30827 11.5161 8.00882C11.8022 7.70936 12.1505 7.47635 12.5365 7.32624C12.9225 7.17612 13.3368 7.11255 13.75 7.14003C14.3498 7.14824 14.9482 7.20173 15.54 7.30003V9.30003H14.54C14.3676 9.27828 14.1924 9.29556 14.0276 9.35059C13.8627 9.40562 13.7123 9.49699 13.5875 9.61795C13.4627 9.73891 13.3667 9.88637 13.3066 10.0494C13.2464 10.2125 13.2237 10.387 13.24 10.56V12.07H15.46L15.1 14.4H13.25V20C15.1399 19.7011 16.8601 18.7347 18.0985 17.2761C19.3369 15.8175 20.0115 13.9634 20 12.05Z"/>
                    </svg>
                </a>
                <a href="https://www.twitter.com" target="_blank">
                    <svg fill="currentColor" width="40px" height="40px" viewBox="-4 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-primary hover:text-tertiary transition-colors duration-300">
                        <title>twitter</title>
                        <path d="M24 8.531c-0.688 1-1.5 1.844-2.469 2.563 0.031 0.219 0.031 0.438 0.031 0.656 0 6.5-4.938 14-14 14-2.781 0-5.375-0.844-7.563-2.219 0.375 0.031 0.781 0.094 1.188 0.094 2.313 0 4.406-0.813 6.094-2.125-2.188-0.031-3.969-1.5-4.594-3.438 0.281 0.063 0.625 0.094 0.938 0.094 0.438 0 0.906-0.063 1.313-0.188-2.281-0.438-3.969-2.406-3.969-4.781v-0.063c0.688 0.344 1.406 0.563 2.219 0.594-1.313-0.906-2.188-2.406-2.188-4.094 0-0.906 0.25-1.75 0.656-2.5 2.438 2.969 6.063 4.969 10.156 5.156-0.063-0.344-0.125-0.75-0.125-1.125 0-2.719 2.188-4.938 4.906-4.938 1.438 0 2.719 0.625 3.625 1.594 1.125-0.219 2.156-0.656 3.094-1.219-0.344 1.156-1.125 2.156-2.125 2.75 1-0.125 1.906-0.406 2.813-0.813z"></path>
                    </svg>
                </a>
                <a href="https://www.instagram.com" target="_blank">
                    <svg fill="currentColor" height="40px" width="40px" viewBox="0 0 48 48" version="1.1" id="Shopicons" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="w-8 h-10 text-primary hover:text-tertiary transition-colors duration-300">
                        <path d="M36,4H12c-4.4,0-8,3.6-8,8v24c0,4.4,3.6,8,8,8h24c4.4,0,8-3.6,8-8V12C44,7.6,40.4,4,36,4z M24,34c-5.5,0-10-4.5-10-10
		                s4.5-10,10-10s10,4.5,10,10S29.5,34,24,34z M35,15c-1.1,0-2-0.9-2-2c0-1.1,0.9-2,2-2s2,0.9,2,2C37,14.1,36.1,15,35,15z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <div class="w-screen bg-primary py-4 mt-8 relative left-1/2 right-1/2 -ml-[50vw] -mr-[50vw]"> <!-- Hacer que el div ocupe todo el ancho -->
        <div class="text-center text-sm mt-0">
            <p class="text-white">©ToysRusUpo 2024, All rights reserved.</p>
        </div>
    </div>
</div>
