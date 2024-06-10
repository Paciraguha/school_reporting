
@extends('layouts.app')
@section('content')
        <div class="flex flex-col justify-center items-center h-screen bg-slate-100">
        <h3 class="py-2 border-b-2 border-red-900 my-4">
             {{ __("New staff registrartion page") }}
        </h3>
        <div class="w-full max-w-[500px] border border-gray-800 p-16 rounded-lg shadow-lg flex flex-col" >
        <form class=" w-[100%] mx-auto" method="POST"  id="registerForm">
          @csrf
          <div class="mb-2">
                <label for="firstname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First name</label>
                <input type="text" id="firstname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Iraguha" name="firstname"  />
            </div>
          <div class="mb-2">
                <label for="lastname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last name</label>
                <input type="text" id="lastname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pacifique" name="lastname"  />
            </div>
            <div class="mb-2">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                <input type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" name="email"  />
            </div>
            <div class="mb-2">
                <label for="telephone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telephone</label>
                <input type="text" id="telephone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0787031933" name="telephone"  />
            </div>
            <div class="mb-2">
                <label for="position" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Position</label>
               <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="position" name="position"  autocomplete="position">
                    <option>Select Position</option>
                    <option value="HeadTeacher">Head Teacher</option>
                    <option value="DOS">DOS</option>
                    <option value="Teacher">Teacher</option>
                </select>
            </div>
            <div class="mb-2">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                <input type="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="password"  />
            </div>
            <div class="mb-2">
                <label for="passwordConfirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
                <input type="password" id="passwordConfirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  name="passwordConfirmation"  />
            </div>
            <button type="submit"  class="text-white bg-gray-800  hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Register</button>
            </form>
            <div class="w-full py-4 text-[#FF0000]" id="registerError"></div>
        </div>
        </div>


 <script>



let registerForm = document.getElementById("registerForm");
  
  registerForm.addEventListener("submit", async(e) => {
   e.preventDefault();
  
      let firstname = document.getElementById("firstname").value;
      let lastname = document.getElementById("lastname").value;
      let email = document.getElementById("email").value;
      let telephone= document.getElementById("telephone").value;
      let position = document.getElementById("position").value;
      let password = document.getElementById("password").value;
      let password_confirmation=document.getElementById("passwordConfirmation").value;

      let registerError=document.getElementById("registerError");
      registerError.innerHTML="";
      let data={
             firstName:firstname,
             lastName:lastname,
             telephone,
             position,
             email,
             password,
             password_confirmation
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
      const response = await fetch(`{{route('registerStaff') }}`,userRequest )
     
      .then(res => res.json())
      .then(data => {
          if(data.status){
              const user=data.user
              window.location.href="/schoolStaffList"
          }else{
            registerError.innerHTML=data.message;
            if(data.error){
                const error=data.error;
                if(data.error.firstName){
                    registerError.innerHTML=data.error.firstName; 
                }

                else if(data.error.lastName){
                    registerError.innerHTML=data.error.lastName; 
                }
                else if(data.error.email){
                    registerError.innerHTML=data.error.email; 
                }
               else if(data.error.telephone){
                    registerError.innerHTML=data.error.telephone; 
                }
                else if(data.error.password){
                    registerError.innerHTML=data.error.password; 
                }
                else{
                    registerError.innerHTML="";  
                }
                console.log(error)
               console.log(error.length)
            }
             
             
          }

      // enter you logic when the fetch is successful
         
      })
      } catch (error) {
          console.log('Fetch error: ', error);
      }
  });


 </script>
  @endsection