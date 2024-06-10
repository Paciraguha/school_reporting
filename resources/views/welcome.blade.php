<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>School Attendance Report</title>

        @vite('resources/js/app.js')
    </head>

    <body class="antialiased">
        <nav class="bg-gray-800 fixed w-full top-0">
            <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
                <div class="relative flex h-16 items-center justify-between">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button-->
                    <button type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <!--
                        Icon when menu is closed.

                        Menu open: "hidden", Menu closed: "block"
                    -->
                    <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!--
                        Icon when menu is open.

                        Menu open: "block", Menu closed: "hidden"
                    -->
                    <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    </button>
                </div>
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex flex-shrink-0 items-center">
                    <img class="h-8 w-auto" src="{{asset('assets/images/education.png')}}" alt="Your Company">
                    </div>
                    <div class="hidden sm:ml-6 sm:block w-full">
                    <div class="flex space-x-4" >
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        <a href="#" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">SARS</a>
                        <div class="w-full flex justify-center text-[#FFFF] font-serif font-bold items-center">
                            School Attendance Reporting System
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>

            <!-- Mobile menu, show/hide based on menu state. -->
            <div class="sm:hidden" id="mobile-menu">
                <div class="space-y-1 px-2 pb-3 pt-2">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <a href="#" class="bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page">SARS</a>
                </div>
            </div>
            </nav>
     
        <div class="flex flex-col justify-center items-center h-screen bg-slate-100">
            <img  src="{{asset('assets/images/education.png')}}"  class="w-[100px] my-3">
            <div class="w-full max-w-[500px] border border-gray-800 flex flex-col p-16 rounded-lg" >
        
            <form class=" w-[100%] mx-auto" method="POST" action="#" id="loginForm">
            @csrf
                <div class="mb-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                    <input type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required />
                </div>
                <div class="mb-5">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                    <input type="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                </div>
                <button type="submit" onclick="" class="text-white bg-gray-800  hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button>
                </form>
                <div class="w-full py-4 text-[#FF0000]" id="loginError"></div>
            </div>
           
        </div>
    </body>

</html>
<script>

    let loginForm = document.getElementById("loginForm");
  
    loginForm.addEventListener("submit", async(e) => {
     e.preventDefault();
    
        let email = document.getElementById("email").value;
        let password = document.getElementById("password").value;
        let loginError=document.getElementById("loginError");
        loginError.innerHTML="";
        let data={
                email,
                password
            }
        console.log(data)
        const userRequest = {
            method: 'POST',
              mode: 'cors',
            headers: {
                Accept: 'application/json',
                'Content-Type': 'application/json',
            },
            body:JSON.stringify(data)
        };

        try {
        const response = await fetch(`http://localhost:8000/api/login`,userRequest )
       
        .then(res => res.json())
        .then(data => {
            if(data.status){
                localStorage.setItem('auth_token', data.token);
                const user=data.user
                console.log(data.token)
                if(user.position==="teacher"){
                    window.location.href="{!! route('studentAttendance') !!}"
                }else if(user.position==="HeadTeacher"){
                    window.location.href="{!! route('headTeacherHome') !!}"
                }else if(user.position==="DEO"){
                    window.location.href="{!! route('home') !!}"
                }else if(user.position==="DOS"){

                }

               console.log(data.user)
            }else{
                loginError.innerHTML=data.message;
            }

        // enter you logic when the fetch is successful
            console.log(data)
        })
        } catch (error) {
            console.log('Fetch error: ', error);
        }
    });



</script>