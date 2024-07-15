@extends('layouts.doslayout')

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

    .btn {
        @apply font-bold py-2 px-4 rounded;
    }
    .btn-blue {
        @apply bg-blue-500 text-white;
    }
    .btn-blue:hover {
        @apply bg-blue-700;
    }

</style>
<div class="container"  style="padding-left:20px;padding-right:20px;margin-right:50px;margin:auto">



            <div class="flex flex-col w-full md:w-[80%]  border border-amber-300 px-5 py-8 mt-12 mx-auto">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                       
                    <h3 class="py-2 border-b-2 border-red-900 my-4 w-full" id="table-title">
                        {{ __("School Classes") }}
                    </h3>
                    <div class="overflow-hidden">
                    <table class="min-w-full text-left text-sm font-light text-surface dark:text-white" >
                            <thead class="border-b border-neutral-200 font-medium dark:border-white/10">
                            <tr>
                                <td rowspan="2" class="px-6 py-4">No</td>
                                <td class="px-6 py-4"> School Code</td>
                                <td class="px-6 py-4">Classes </td>
                                <td class="px-6 py-4 text-center">Actions</td>
                            </tr>
                        </thead>
                        <tbody id="class-section-table">
                        
                        </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- submit button ----------------------------------------- -->
</div>

<script>
   const token = localStorage.getItem('auth_token');
 $(document).ready(function() {
    getAllClass()

function getAllClass(){
    const SchoolClass=document.getElementById("class-section-table")
    $.ajax({
        type: 'GET',
        url: '{!! route('apiGetSchoolClass') !!}',
        headers: {
            'Authorization': 'Bearer ' + token
           
             },
        dataType: 'json',
        success: function(response) {
            const data=response;
            let i=0;
            data.forEach((response)=>{
                const classStudent = `/studentinclass/${response.id}`;
                const studendentInClass=`/dosStdudentInClass?studentsClass=${response.id}`
           i++
            const table1=`
            <tr class="border-b border-neutral-200 dark:border-white/10 tr-data">
                <td class="whitespace-nowrap px-6 py-4">${i}</td>
                <td class="whitespace-nowrap px-6 py-4">${response.SchoolCode}</td>
                <td class="whitespace-nowrap px-6 py-4">${response.SchoolClass}</td>
                <td class="whitespace-nowrap px-6 py-4 flex justify-evenly">
                <a  href="${classStudent}" class="bg-blue hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"> Attendance statistic</button>
                <a  href="${studendentInClass}" class="bg-grey hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Daily Attendance</button>
                </td>
            </tr>
            `

            SchoolClass.insertAdjacentHTML("beforeend",table1);
          
        })
        
        },
        error: function(xhr, status, error) {
            // Handle errors if needed
            console.error(error);
        }
    });
}



 })




</script>
@endsection


