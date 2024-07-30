@extends('layouts.seolayout')

@section('content')
<style>
  
    .count-input{
        background:yellow;
        display:flex;
        flex-direction:row;
        align-content:center;
        justify-content:space-around
    }
    .count-input div{
        width:100px;
        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:space-around
    }
</style>
<div class="container"  style="padding-left:20px;padding-right:20px;margin-right:50px;margin:auto">

<div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Register new School
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" action="#">
                   <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sector</label>
                        <select type="email" name="email"   id="sector-options"
                         class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" 
                         placeholder="TTC MURURU"    >
                         <option>Select Sector</option>
                    </select>
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">School Name</label>
                        <input type="text" name="schoolname" id="school-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required />
                    </div>
                    
                    <div class="flex justify-between" id='school-levels'>
                        
                    </div>
                    <button type="button" id="addSchool-button"
                     class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add School</button>
                </form>
            </div>
        </div>
    </div>
</div> 




<div id="authentication-modal-update" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                  Update school info
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal-update">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" action="#">
                    <div>
                     <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">School Id</label>
                     <input type="text" name="school_id" id="school-Id-update" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" readonly />
                    </div>
                   <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sector</label>
                        <select type="email" name="email"   id="sector-options-update"
                         class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" 
                         placeholder="TTC MURURU"    >
                         <option>Select Sector</option>
                    </select>
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">School Name</label>
                        <input type="text" name="schoolname" id="school-name-update" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required />
                    </div>
                    
                    <div class="flex justify-between" id='school-levels-update'>
                        
                    </div>
                    <button type="button" id="updateSchool-button"
                     class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                </form>
            </div>
        </div>
    </div>
</div> 






<div class="flex flex-col w-full  md:w-[100%] border border-amber-300 px-1 py-8 mt-10">
    <div class="overflow-x-auto sm:-mx-6 mx-auto w-[100%]" >
        <div class="inline-block py-2 sm:px-1 lg:px-4 w-full">
            <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" 
              class="block float-end text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" 
              type="button">
                Add new School
            </button>
            <h3 class="py-2 border-b-2 border-red-900 my-4">
             {{ __("Schools in districts") }}
            </h3>
          <div>
                        <table class="min-w-full text-left text-sm font-light text-surface dark:text-white" id="school-section-table">
                        <thead class="border-b border-neutral-200 font-medium dark:border-white/10">
                            <tr>
                                <td rowspan="2" class="px-6 py-4">No</td>
                                <td rowspan="2" class="px-6 py-4">Date of Registration</td>
                                <td class="px-6 py-4"> Sector Code</td>
                                <td class="px-6 py-4"> School Code</td>
                                <td class="px-6 py-4">School Name</td>
                                <td class="px-6 py-4">School Levels</td>
                                <td colspan="2" class="px-6 py-4">Actions</td>
                            </tr>
                        </thead>
                        <tbody id="school-section-table">
                        </tbody>
                        </table>

       </div>
    </div>
   </div>
       
    <!-- submit button ----------------------------------------- -->
</div>

<script>

const token = localStorage.getItem('auth_token');
 $(document).ready(function() {
 
    getSectorInfo()
    getClassLevels()
 
    $("#addSchool-button").click(function(){
        addNewSchool()
    })
    $("#updateSchool-button").click(function(){
        submitSchoolInformation()
    })
})

const urlParams = new URLSearchParams(window.location.search);
    if(urlParams.get('sectorcode')){
        const sectorCode = urlParams.get('sectorcode');
        getAllSchoolBySecotor(sectorCode)
    }else{
        getAllSchool()
    }


function updateSectors(id){
    const sector=document.getElementById("sector-options-update")
    $.ajax({
        type: 'GET',
        url: '{!! route('getAllSectors') !!}',
        headers: {
            'Authorization': 'Bearer ' + token
             },
        dataType: 'json',
        success: function(response) {
            const data=response;
            let i=0;
            data.forEach((response)=>{
           i++
            const options=`
                <Option ${response.SectorCode===id?"selected":""} value="${response.SectorCode}">${response.SectorName}</Option>
            `
           sector.insertAdjacentHTML("beforeend",options);
        })
        },
        error: function(xhr, status, error) {
            // Handle errors if needed
            console.error(error);
        }
    });
}


function getSectorInfo(){
    const sector=document.getElementById("sector-options")
    $.ajax({
        type: 'GET',
        url: '{!! route('getAllSectors') !!}',
        headers: {
            'Authorization': 'Bearer ' + token
             },
        dataType: 'json',
        success: function(response) {
            const data=response;
            let i=0;
            data.forEach((response)=>{
           i++
            const options=`
                <Option value="${response.SectorCode}">${response.SectorName}</Option>
            `
           sector.insertAdjacentHTML("beforeend",options);
        })
        },
        error: function(xhr, status, error) {
            // Handle errors if needed
            console.error(error);
        }
    });
}

function getClassLevels(){
    const school_levels=document.getElementById("school-levels")
    $.ajax({
        type: 'GET',
        url: '{!! route('getClassLevels') !!}',
        headers: {
            'Authorization': 'Bearer ' + token,
             },
        dataType: 'json',
        success: function(response) {
            const data=response;
            let i=0;
            data.forEach((response)=>{
           console.log(response)
           i++
            const options=`
                         <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="${response.levels}" name="classLevel[]" type="checkbox" value="${response.id}" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 school-level" required />
                            </div>
                            <label for="${response.levels}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">${response.levels}</label>
                        </div>
            `
            school_levels.insertAdjacentHTML("beforeend",options);
        })
        },
        error: function(xhr, status, error) {
            // Handle errors if needed
            console.log(error);
        }
    });
}




function updateSchoolLevel(schoolLevels) {
    console.log("=========================================", schoolLevels);
    const school_levels = document.getElementById("school-levels-update");
    $.ajax({
        type: 'GET',
        url: '{!! route('getClassLevels') !!}',
        headers: {
            'Authorization': 'Bearer ' + token,
        },
        dataType: 'json',
        success: function(response) {
            school_levels.innerHTML = ''; 
            const data = response;
            data.forEach((response) => {
                let checked = '';
                schoolLevels.forEach(element => {
                    if (element.levels === response.levels) {
                        checked = 'checked="true"';
                    }
                });
                const options = `
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input ${checked} id="${response.levels}" name="classLevel[]" type="checkbox" value="${response.id}" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 school-level" required />
                            </div>
                            <label for="${response.levels}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">${response.levels}</label>
                        </div>
                    `;
                    school_levels.insertAdjacentHTML("beforeend", options);
            });
        },
        error: function(xhr, status, error) {
            // Handle errors if needed
            console.log(error);
        }
    });
}









function getAllSchool() {
    const schools = document.getElementById("school-section-table");

    $.ajax({
        type: 'GET',
        url: '{!! route('getAllSchools') !!}',
        headers: {
            'Authorization': 'Bearer ' + token,
        },
        dataType: 'json',
        success: function(response) {
            try {
                if (Array.isArray(response)) {
                    let i = 0;
                    response.forEach((school) => {
                        let levels = school.SchoolLevels.map(level => level.levels);
                        i++;
                        let result = levels.join(", ");
                        const tableRow = `
                            <tr class="border-b border-neutral-200 dark:border-white/10 tr-data">
                                <td class="whitespace-nowrap px-6 py-4">${i}</td>
                                <td class="whitespace-nowrap px-6 py-4">${school.created_at.split('T')[0]}</td>
                                <td class="whitespace-nowrap px-6 py-4">${school.SectorCode}</td>
                                <td class="whitespace-nowrap px-6 py-4">${school.SchoolCode}</td>
                                <td class="whitespace-nowrap px-6 py-4">${school.SchoolName}</td>
                                <td class="whitespace-nowrap px-6 py-4">${result}</td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                        Students
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start w-[250px] z-3">
                                        <li><a href="/school_student-attendance-report/${school.id}"  class="dropdown-item"  style="display:flex;flex-direction:cols"><img src="{{asset('assets/images/icons8-report-50.png')}}" class="w-[40px] px-2"/> Attendance Report</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="/school_student-attendance-statistic/${school.id}" style="display:flex;flex-direction:cols"> <img src="{{asset('assets/images/icons8-stats-32.png')}}" class="w-[40px] px-2"/>Attendance statistic</a></li>
                                                
                                    </ul>
                                    </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                    <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                        Teachers
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start w-[250px] z-3">
                                            <li><a href='/school_staff-attendance-statistic/${school.id}'  class="dropdown-item"   href="#"  style="display:flex;flex-direction:cols"> <img src="{{asset('assets/images/icons8-stats-32.png')}}" class="w-[40px] px-2"/> Attendance statistic</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a href="/school_staff-attendance-report/${school.id}" class="dropdown-item"   href="#"  style="display:flex;flex-direction:cols"> <img src="{{asset('assets/images/icons8-report-50.png')}}" class="w-[40px] px-2"/> Attendance report</a></li>
                                    </ul>
                                    </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4"> 
                                    <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                        more action
                                    </button>
                                 
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start z-3 w-[150px]">
                                        <li><a onclick='updateschool(${JSON.stringify(school)})'  class="dropdown-item"  href="#" data-modal-target="authentication-modal-update" data-modal-toggle="authentication-modal-update"  style="display:flex;flex-direction:cols"> <img src="{{asset('assets/images/icons8-edit-26.png')}}" class="w-[35px] px-2"/>Edit</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a onClick='deleteSChool(${school.id})' class="dropdown-item"  style="display:flex;flex-direction:cols"> <img src="{{asset('assets/images/trash-outline.svg')}}" class="w-[40px] px-2 text-white"/>Delete</a></li>
                                    </ul>
                                    </div>
                                    </td>
                            </tr>
                        `;
                        schools.insertAdjacentHTML("beforeend", tableRow);
                    });
                } else {
                    console.error("Unexpected response format:", response);
                }
            } catch (error) {
                console.error("Error processing response:", error);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error fetching school data:", xhr.responseText || xhr.statusText, error);
        }
    });
}


function getAllSchoolBySecotor(id) {
    const schools = document.getElementById("school-section-table");

    $.ajax({
        type: 'GET',
        url: '{!! route('getAllSchools') !!}',
        headers: {
            'Authorization': 'Bearer ' + token,
        },
        data:{sectorCode:id},
        dataType: 'json',
        success: function(response) {
            try {
                if (Array.isArray(response)) {
                    let i = 0;
                    response.forEach((school) => {
                        let levels = school.SchoolLevels.map(level => level.levels);
                        i++;
                        let result = levels.join(", ");
                        const tableRow = `
                            <tr class="border-b border-neutral-200 dark:border-white/10 tr-data">
                                <td class="whitespace-nowrap px-6 py-4">${i}</td>
                                <td class="whitespace-nowrap px-6 py-4">${school.created_at.split('T')[0]}</td>
                                <td class="whitespace-nowrap px-6 py-4">${school.SectorCode}</td>
                                <td class="whitespace-nowrap px-6 py-4">${school.SchoolCode}</td>
                                <td class="whitespace-nowrap px-6 py-4">${school.SchoolName}</td>
                                <td class="whitespace-nowrap px-6 py-4">${result}</td>
                                <td class="whitespace-nowrap px-6 py-4">
                                <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                    Students
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start w-[250px] z-3">
                                    <li><a href="/SectorAttendanceReport/${response.SectorCode}"  class="dropdown-item"  style="display:flex;flex-direction:cols"><img src="{{asset('assets/images/icons8-report-50.png')}}" class="w-[40px] px-2"/> Attendance Report</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="/DistrictStudents?sectorcode=${response.SectorCode}" style="display:flex;flex-direction:cols"> <img src="{{asset('assets/images/icons8-stats-32.png')}}" class="w-[40px] px-2"/>Attendance statistic</a></li>
                                            
                                </ul>
                                </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                    Teachers
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start w-[250px] z-3">
                                        <li><a onclick="openModal(${response.SectorCode})"  class="dropdown-item"  href="#" data-modal-target="modal" data-modal-toggle="modal"  style="display:flex;flex-direction:cols"> <img src="{{asset('assets/images/reorder-four-outline.svg')}}" class="w-[40px] px-2"/>All staff</a></li>
                                        <li><a onClick='studentInfo(${JSON.stringify(school)})'  class="dropdown-item"   href="#"  style="display:flex;flex-direction:cols"> <img src="{{asset('assets/images/icons8-stats-32.png')}}" class="w-[40px] px-2"/> Attendance statistic</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a href="/SectorAttendanceReport/${response.SectorCode}" class="dropdown-item"   href="#"  style="display:flex;flex-direction:cols"> <img src="{{asset('assets/images/icons8-report-50.png')}}" class="w-[40px] px-2"/> Attendance report</a></li>
                                </ul>
                                </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4"> 
                                <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                    more action
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start z-3 w-[150px]">
                                    <li><a href="/addSchool?sectorcode=${response.SectorCode}"  class="dropdown-item"  style="display:flex;flex-direction:cols"> <img src="{{asset('assets/images/reorder-four-outline.svg')}}" class="w-[40px] px-2"/> school list</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a onclick='updateschool(${JSON.stringify(school)})'  class="dropdown-item"  href="#" data-modal-target="authentication-modal-update" data-modal-toggle="authentication-modal-update"  style="display:flex;flex-direction:cols"> <img src="{{asset('assets/images/icons8-edit-26.png')}}" class="w-[35px] px-2"/>Edit</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a onClick='deleteSChool(${school.id})' class="dropdown-item"  style="display:flex;flex-direction:cols"> <img src="{{asset('assets/images/trash-outline.svg')}}" class="w-[40px] px-2 text-white"/>Delete</a></li>
                                </ul>
                                </div>
                                </td>
                            </tr>
                        `;
                        schools.insertAdjacentHTML("beforeend", tableRow);
                    });
                } else {
                    console.error("Unexpected response format:", response);
                }
            } catch (error) {
                console.error("Error processing response:", error);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error fetching school data:", xhr.responseText || xhr.statusText, error);
        }
    });
}





function formValue(){
   // alert("testttt")
let SectorCode=document.getElementById("sector-options").value
let SchoolName=document.getElementById("school-name").value
let checkedLevel=document.querySelectorAll('input[type="checkbox"]:checked');
let schoolLevel=[];
 for (var checkbox of checkedLevel) {  
    //document.body.append(checkbox.value + ' ');  
    schoolLevel.push(checkbox.value)
  }  
    
const data={
   SectorCode,
   SchoolName,
   schoolLevel
}
console.log(data)
return data
}

function addNewSchool(){
           const formData =formValue();
      
            $.ajax({
                type: 'POST',
                url: '{!! route('addNewSchool') !!}',
                headers: {
                'Authorization': 'Bearer ' + token
                },
                data: formData,
                dataType: 'json',
                success: function(response) {
                   // console.log(response)
                   window.location.reload()
                },
                error: function(xhr, status, error) {
                    // Handle errors if needed
                    console.log(xhr);
                }
            });
          
        }


function submitSchoolInformation(){
    let SchoolId=document.getElementById("school-Id-update").value
    let SectorCode=document.getElementById("sector-options-update").value
    let SchoolName=document.getElementById("school-name-update").value
    let checkedLevel=document.querySelectorAll('input[type="checkbox"]:checked');
    let schoolLevel=[];
    for (var checkbox of checkedLevel) {  
        //document.body.append(checkbox.value + ' ');  
        schoolLevel.push(checkbox.value)
    }  
    
const formData={
   SchoolId,
   SectorCode,
   SchoolName,
   schoolLevel
}

        $.ajax({
                type: 'POST',
                url: '{!! route('updateSchoolInfo') !!}',
                headers: {
                'Authorization': 'Bearer ' + token
                },
                data: formData,
                dataType: 'json',
                success: function(response) {
                    alert(response.message)
                     window.location.reload()
                },
                error: function(xhr, status, error) {
                    // Handle errors if needed
                    console.log(xhr);
                }
            });

}




function updateschool(school){
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(checkbox => {
        checkbox.checked = false;
    });
    updateSectors(school.SectorCode)
    updateSchoolLevel(school.SchoolLevels)
    document.getElementById("school-Id-update").value=school.id
    document.getElementById("school-name-update").value=school.SchoolName
}



function deleteSChool(id){
const url = `/api/deleteschoolinfo/${id}`;
$.ajax({
        type: 'GET',
        url: url,
        headers: {
            'Authorization': 'Bearer ' + token
            },
     
        success: function(response) {
            const data = response;
            alert(response.message)
            console.log("===========================================================",data)
            window.location.reload()
        },
        error: function(xhr, status, error) {
        }
    });
}





</script>
@endsection


