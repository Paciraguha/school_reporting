@extends('layouts.seolayout')

@section('content')
<div class="container">
<div class="container items-center px-4  m-auto mt-0">

<div class="flex flex-wrap pb-3 mx-4 md:mx-24 lg:mx-0 col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-8 xxl:col-span-8 px-6 py-4">
<div class="w-[99%] flex justify-center items-center py-8 px-5 bg-white rounded shadow-sm dark:bg-gray-800 mb-5">
   <p class="w-full text-center text-2xl text-gray-400"> Sector Education Over View</p>
</div>
     

  <div class="w-full p-2 lg:w-1/3 md:w-1/2">
    <div
      class="flex flex-col px-6 py-10 overflow-hidden bg-white hover:bg-gradient-to-br hover:from-purple-400 hover:via-blue-400 hover:to-blue-500 rounded-xl shadow-lg duration-300 hover:shadow-2xl group">
      <div class="flex flex-row justify-between items-center">
        <div class="px-4 py-4 bg-gray-300  rounded-xl bg-opacity-30">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:text-gray-50" viewBox="0 0 20 20"
            fill="currentColor">
            <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z" />
          </svg>
        </div>
        <div class="inline-flex text-sm text-gray-600 group-hover:text-gray-200 sm:text-base">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-green-500 group-hover:text-gray-200"
            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <span id="school_value_small">0</span>
        </div>
      </div>
      <h1 class="text-3xl sm:text-4xl xl:text-5xl font-bold text-gray-700 mt-12 group-hover:text-gray-50">  <span id="school_value_big">0</span></h1>
      <div class="flex flex-row justify-between group-hover:text-gray-200">
        <p>Schools</p>
        <span>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600 group-hover:text-gray-200"
            viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
              clip-rule="evenodd" />
          </svg>
        </span>
      </div>
    </div>
  </div>
  <div class="w-full p-2 lg:w-1/3 md:w-1/2">
    <div
      class="flex flex-col px-6 py-10 overflow-hidden bg-white hover:bg-gradient-to-br hover:from-purple-400 hover:via-blue-400 hover:to-blue-500 rounded-xl shadow-lg duration-300 hover:shadow-2xl group">
      <div class="flex flex-row justify-between items-center">
        <div class="px-4 py-4 bg-gray-300  rounded-xl bg-opacity-30">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:text-gray-50" viewBox="0 0 20 20"
            fill="currentColor">
            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
            <path fill-rule="evenodd"
              d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
              clip-rule="evenodd" />
          </svg>
        </div>
        <div class="inline-flex text-sm text-gray-600 group-hover:text-gray-200 sm:text-base">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-green-500 group-hover:text-gray-200"
            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <span id="staff_value_small">0</span>
        </div>
      </div>
      <h1 class="text-3xl sm:text-4xl xl:text-5xl font-bold text-gray-700 mt-12 group-hover:text-gray-50">  <span id="staff_value_big">0</span></h1>
      <div class="flex flex-row justify-between group-hover:text-gray-200">
        <p>School staff</p>
        <span>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600 group-hover:text-gray-200"
            viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
              clip-rule="evenodd" />
          </svg>
        </span>
      </div>
    </div>
  </div>
  <div class="w-full p-2 lg:w-1/3 md:w-1/2">
    <div
      class="flex flex-col px-6 py-10 overflow-hidden bg-white hover:bg-gradient-to-br hover:from-purple-400 hover:via-blue-400 hover:to-blue-500 rounded-xl shadow-lg duration-300 hover:shadow-2xl group">
      <div class="flex flex-row justify-between items-center">
        <div class="px-4 py-4 bg-gray-300  rounded-xl bg-opacity-30">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:text-gray-50" viewBox="0 0 20 20"
            fill="currentColor">
            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
          </svg>
        </div>
        <div class="inline-flex text-sm text-gray-600 group-hover:text-gray-200 sm:text-base">
        <img  src="{{asset('assets/images/education.png')}}"  class="w-8 mr-2 text-green-500 group-hover:text-gray-200">
          <span id="total_student_value_small">0</span>
        </div>
      </div>
      <h1 class="text-3xl sm:text-4xl xl:text-5xl font-bold text-gray-700 mt-12 group-hover:text-gray-50"><span id="total_student_value_big">0</span>
      </h1>
      <div class="flex flex-row justify-between group-hover:text-gray-200">
        <p>Total students</p>
        <span>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600 group-hover:text-gray-200"
            viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
              clip-rule="evenodd" />
          </svg>
        </span>
      </div>
    </div>
  </div>
</div>

<div class="flex flex-wrap pb-3 mx-4 md:mx-24 lg:mx-0 justify-center">
      
          <p class="w-full  py-8 px-5 text-center text-2xl text-gray-400"> Student General Data By School Level</p>

     <div class="w-full p-2 lg:w-1/4 md:w-1/2">
       <div
         class="flex flex-col px-6 py-10 overflow-hidden bg-white hover:bg-gradient-to-br hover:from-purple-400 hover:via-blue-400 hover:to-blue-500 rounded-xl shadow-lg duration-300 hover:shadow-2xl group">
         <div class="flex flex-row justify-between items-center">
           <div class="px-4 py-4 bg-gray-300  rounded-xl bg-opacity-30">
             <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:text-gray-50" viewBox="0 0 20 20"
               fill="currentColor">
               <path fill-rule="evenodd"
                 d="M10.293 15.707a1 1 0 010-1.414L14.586 10l-4.293-4.293a1 1 0 111.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z"
                 clip-rule="evenodd" />
               <path fill-rule="evenodd"
                 d="M4.293 15.707a1 1 0 010-1.414L8.586 10 4.293 5.707a1 1 0 011.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z"
                 clip-rule="evenodd" />
             </svg>
           </div>
           <div class="inline-flex text-sm text-gray-600 group-hover:text-gray-200 sm:text-base">
             <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-green-500 group-hover:text-gray-200"
               fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
               <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
             </svg>
             <span id="nussery_student_value_small">0</span>
           </div>
         </div>
         <h1 class="text-3xl sm:text-4xl xl:text-5xl font-bold text-gray-700 mt-12 group-hover:text-gray-50">
         <span id="nussery_student_value_big">0</span>
         </h1>
         <div class="flex flex-row justify-between group-hover:text-gray-200">
           <p>Nusery Schools</p>
           <span>
             <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600 group-hover:text-gray-200"
               viewBox="0 0 20 20" fill="currentColor">
               <path fill-rule="evenodd"
                 d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                 clip-rule="evenodd" />
             </svg>
           </span>
         </div>
       </div>
     </div>
     <div class="w-full p-2 lg:w-1/4 md:w-1/2">
       <div
         class="flex flex-col px-6 py-10 overflow-hidden bg-white hover:bg-gradient-to-br hover:from-purple-400 hover:via-blue-400 hover:to-blue-500 rounded-xl shadow-lg duration-300 hover:shadow-2xl group">
         <div class="flex flex-row justify-between items-center">
           <div class="px-4 py-4 bg-gray-300  rounded-xl bg-opacity-30">
             <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:text-gray-50" viewBox="0 0 20 20"
               fill="currentColor">
               <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z" />
             </svg>
           </div>
           <div class="inline-flex text-sm text-gray-600 group-hover:text-gray-200 sm:text-base">
             <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-green-500 group-hover:text-gray-200"
               fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
               <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
             </svg>
             <span id="primary_student_value_small">0</span>
           </div>
         </div>
         <h1 class="text-3xl sm:text-4xl xl:text-5xl font-bold text-gray-700 mt-12 group-hover:text-gray-50">
         <span id="primary_student_value_big">0</span>
          </h1>
         <div class="flex flex-row justify-between group-hover:text-gray-200">
           <p>Primary Schools</p>
           <span>
             <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600 group-hover:text-gray-200"
               viewBox="0 0 20 20" fill="currentColor">
               <path fill-rule="evenodd"
                 d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                 clip-rule="evenodd" />
             </svg>
           </span>
         </div>
       </div>
     </div>
     <div class="w-full p-2 lg:w-1/4 md:w-1/2">
       <div
         class="flex flex-col px-6 py-10 overflow-hidden bg-white hover:bg-gradient-to-br hover:from-purple-400 hover:via-blue-400 hover:to-blue-500 rounded-xl shadow-lg duration-300 hover:shadow-2xl group">
         <div class="flex flex-row justify-between items-center">
           <div class="px-4 py-4 bg-gray-300  rounded-xl bg-opacity-30">
             <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:text-gray-50" viewBox="0 0 20 20"
               fill="currentColor">
               <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
               <path fill-rule="evenodd"
                 d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                 clip-rule="evenodd" />
             </svg>
           </div>
           <div class="inline-flex text-sm text-gray-600 group-hover:text-gray-200 sm:text-base">
             <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-green-500 group-hover:text-gray-200"
               fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
               <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
             </svg>
             <span id="secondary_student_value_small">0</span>
           </div>
         </div>
         <h1 class="text-3xl sm:text-4xl xl:text-5xl font-bold text-gray-700 mt-12 group-hover:text-gray-50">
         <span id="secondary_student_value_big">0</span>
         </h1>
         <div class="flex flex-row justify-between group-hover:text-gray-200">
           <p>Secondary Schools</p>
           <span>
             <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600 group-hover:text-gray-200"
               viewBox="0 0 20 20" fill="currentColor">
               <path fill-rule="evenodd"
                 d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                 clip-rule="evenodd" />
             </svg>
           </span>
         </div>
       </div>
     </div>
     <div class="w-full p-2 lg:w-1/4 md:w-1/2">
       <div
         class="flex flex-col px-6 py-10 overflow-hidden bg-white hover:bg-gradient-to-br hover:from-purple-400 hover:via-blue-400 hover:to-blue-500 rounded-xl shadow-lg duration-300 hover:shadow-2xl group">
         <div class="flex flex-row justify-between items-center">
           <div class="px-4 py-4 bg-gray-300  rounded-xl bg-opacity-30">
             <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:text-gray-50" viewBox="0 0 20 20"
               fill="currentColor">
               <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
             </svg>
           </div>
           <div class="inline-flex text-sm text-gray-600 group-hover:text-gray-200 sm:text-base">
           <img  src="{{asset('assets/images/education.png')}}"  class="w-8 mr-2 text-green-500 group-hover:text-gray-200">
             <span id="tvet_student_value_small">0</span>
           </div>
         </div>
         <h1 class="text-3xl sm:text-4xl xl:text-5xl font-bold text-gray-700 mt-12 group-hover:text-gray-50">
         <span id="tvet_student_value_big">0</span>
         </h1>
         <div class="flex flex-row justify-between group-hover:text-gray-200">
           <p>TVET Schools</p>
           <span>
             <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600 group-hover:text-gray-200"
               viewBox="0 0 20 20" fill="currentColor">
               <path fill-rule="evenodd"
                 d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                 clip-rule="evenodd" />
             </svg>
           </span>
         </div>
       </div>
     </div>
   </div>
</div>
</div>
@endsection

<script>


function summarystatistic() {
    const token = localStorage.getItem('auth_token');



    const saveData = fetch(`{!! route('summarystatistic') !!}`, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + token
            },

            method: 'get',
        })
        .then(response => response.json())
        .then(result => {
            console.log('Success:');


            document.getElementById("school_value_small").innerText=result.summary.totalschool
            document.getElementById("school_value_big").innerText=result.summary.totalschool

            document.getElementById("staff_value_small").innerText=result.summary.totalstaff
            document.getElementById("staff_value_big").innerText=result.summary.totalstaff

            document.getElementById("total_student_value_small").innerText=result.summary.Totalstudent
            document.getElementById("total_student_value_big").innerText=result.summary.Totalstudent
        
            document.getElementById("nussery_student_value_small").innerText=result.details[0].totalRegistered
            document.getElementById("nussery_student_value_big").innerText=result.details[0].totalRegistered

            document.getElementById("primary_student_value_small").innerText=result.details[1].totalRegistered
            document.getElementById("primary_student_value_big").innerText=result.details[1].totalRegistered

            document.getElementById("secondary_student_value_small").innerText=result.details[2].totalRegistered
            document.getElementById("secondary_student_value_big").innerText=result.details[2].totalRegistered

            document.getElementById("tvet_student_value_small").innerText=result.details[3].totalRegistered
            document.getElementById("tvet_student_value_big").innerText=result.details[3].totalRegistered
           
            //window.location.reload()
        })
}
summarystatistic()
</script>