@extends('layouts.seolayout')

@section('content')
<style>
.count-input {
    background: yellow;
    display: flex;
    flex-direction: row;
    align-content: center;
    justify-content: space-around
}

.count-input div {
    width: 100px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-around
}
</style>

<div class="w-full flex flex-col justify-center items-center mt-[50px]">


<div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg w-1/3">
        <div class="p-4 border-b">
            <div class="flex items-center justify-between p-4 md:p-5  dark:border-gray-600">
                <h3 id="modal-title" class="text-xl font-semibold text-gray-900 dark:text-white">
                    Mark students as an absent to class attendance
                </h3>
                <button type="button" onclick="closeModal()"
                    class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="authentication-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
        </div>
        <div class="p-4">
            <p id="modal-content">
            </p>
            <div class="p-4 md:p-5">
                <form class="space-y-4" action="#" id="assignSchoolForm">
                    <div id="userId-sesction"></div>
                    <div>
                        <label for="sector-options"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose new sector leader</label>
                        <Select  name="comments" id="assign_sector_leader" rows="5" cols="5" max="255"
                            class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white text-left">
                        </select>
                    </div>
                </form>
            </div>
        </div class="w-full flex">
        <div class="p-4 border-t text-left">
            <button type="button" id="add-new-SEO-button"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Add leader</button>
        </div>
    </div>
    <div>
    </div>
</div>
</div>



    <p class="text-[#000] font-semibold text-[24px] w-full pb-3 mb-5 border-b-2 text-center">Sectors in District</p>

    <div
        class="flex flex-col  md:flex-row w-full  md:w-[50%] justify-evenly  border border-amber-300 py-8 shadow-md bg-white rounded-md">
        <input type="text"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500  md:max-w-[60%] mb-4"
            placeholder="sector name " id="sector-input">
        <button
            class="text-white bg-gray-800  hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm  sm:w-auto px-5 py-1.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 h-10"
            id="addSector-button">Add Sector</button>
    </div>

    <div class="flex flex-col w-full  border border-amber-300 px-5 py-8 mt-12">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                        <thead class="border-b border-neutral-200 font-medium dark:border-white/10">
                            <tr>
                                <th scope="col" class="px-6 py-4">No</th>
                                <th scope="col" class="px-6 py-4">Sector code</th>
                                <th scope="col" class="px-6 py-4">Sector Name</th>
                                <th scope="col" class="px-6 py-4">names</th>
                                <th scope="col" class="px-6 py-4">contact</th>
                                <th scope="col" colspan='3' class="px-6 py-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="sector-section-table">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>






<script>
const token = localStorage.getItem('auth_token');
$(document).ready(function() {

    getSectorInfo()
    getAllSEOUSERS()
    $("#addSector-button").click(function() {
        addSectorInfo()
    })
    $("#add-new-SEO-button").click(function() {
        addSectorLeader()
    })

function getAllSEOUSERS(){
    const options = document.getElementById("assign_sector_leader")
        $.ajax({
            type: 'GET',
            url: '{!! route('getAllSEOUSERS') !!}',
            headers: {
                'Authorization': 'Bearer ' + token

            },
            dataType: 'json',
            success: function(response) {
                console.log("++++++++++++++++++++++++++++++++++++++++++++",response)
                const data = response;
                let i = 0;
                data.forEach((res) => {
                    const option1 = `
                    <option value="${res.id}">${res.firstName} ${res.lastName} || ${res.email} </option>
                        
                    `
                    options.insertAdjacentHTML("beforeend", option1);
                })
            }
            })
}



    function getSectorInfo() {
        const sector = document.getElementById("sector-section-table")
        $.ajax({
            type: 'GET',
            url: '{!! route('getAllSectors') !!}',
            headers: {
                'Authorization': 'Bearer ' + token

            },
            dataType: 'json',
            success: function(response) {
                console.log("------------------------------------------",response)
                const data = response;
                let i = 0;
                data.forEach((response) => {

                    i++
                    const table1 = `
                    <tr class="border-b border-neutral-200 dark:border-white/10">
                        <td class="whitespace-nowrap px-6 py-4 font-medium">${i}</td>
                        <td class="whitespace-nowrap px-6 py-4">${response.SectorCode}</td>
                        <td class="whitespace-nowrap px-6 py-4">${response.SectorName}</td>
                        <td class="whitespace-nowrap px-6 py-4">${response.firstName} ${response.lastName}</td>
                        <td class="whitespace-nowrap px-6 py-4"><i>Email:</i> ${response.email} <br/> <i>Tel:</i> ${response.Telephone}</td>
                        <td class="whitespace-nowrap px-6 py-4"><button  onclick="openModal(${response.SectorCode})" class="btn btn-small btn-info">Leader</button></td>
                        <td class="whitespace-nowrap px-6 py-4"><a href="/SectorAttendanceReport/${response.SectorCode}" class="btn btn-small btn-success">Attendance</a></td>
                        <td class="whitespace-nowrap px-6 py-4"><a href="/addSchool?sectorcode=${response.SectorCode}" class="btn btn-small btn-primary">Schools</a></td>
                        <td class="whitespace-nowrap px-6 py-4"><a href="/DistrictStudents?sectorcode=${response.SectorCode}" class="btn btn-small btn-warning">Students</a></td>
                        <td class="whitespace-nowrap px-6 py-4"><button class="btn btn-small btn-outline-primary">Edit</button></td>
                        <td class="whitespace-nowrap px-6 py-4"><button class="btn btn-small btn-outline-danger">Delete</button></td>
                    </tr>
                    `

                    sector.insertAdjacentHTML("beforeend", table1);

                })

            },
            error: function(xhr, status, error) {
                // Handle errors if needed
                console.error(error);
            }
        });
    }


    
function addSectorLeader() {
    let SectorId = document.getElementById("sectorId").value
    let userId=document.getElementById('assign_sector_leader').value
  
    const formData = {
        SectorId,
        userId
    }

    $.ajax({
        type: 'POST',
        url: '{!! route('addNewSEO') !!}',
        headers: {
            'Authorization': 'Bearer ' + token
        },
        data: formData,
        dataType: 'json',
        success: function(response) {
            //console.log("========================================================",response)
          window.location.reload()
        },
        error: function(xhr, status, error) {
            // Handle errors if needed
            console.log(error);
        }
    });
}




    function formValue() {
        // alert("testttt")
        let SectorName = document.getElementById("sector-input").value
        const data = {
            SectorName
        }
        return data
    }

    function addSectorInfo() {
        const formData = formValue();
        console.log(formData)
        // Send an AJAX request
        $.ajax({
            type: 'POST',
            url: '{!! route('addNewSector') !!}',
            headers: {
                'Authorization': 'Bearer ' + token

            },
            data: formData,
            dataType: 'json',
            success: function(response) {
                window.location.reload()
            },
            error: function(xhr, status, error) {
                // Handle errors if needed
                console.error(error);
            }
        });

    }


})

function openModal(user) {
    console.log("???????????????????????????????????????????????????????????/",user)
    var form_container = document.getElementById("userId-sesction");
    var input = document.createElement("input");
    input.type = "text";
    input.name = "sectorId";
    input.value = `${user}`;
    input.id = "sectorId";
    input.hidden = "readonly";
    form_container.appendChild(input);

    document.getElementById('modal-title').innerText = 'Sector Education Officer'
    document.getElementById('modal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('modal').classList.add('hidden');
}
</script>
@endsection