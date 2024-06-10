@extends('layouts.app')

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

<div class="w-full flex flex-col justify-center items-center mt-[50px]">
    <p class="text-[#000] font-semibold text-[24px] w-full pb-3 mb-5 border-b-2 text-center">Sectors in District</p>
    
    <div class="flex flex-col  md:flex-row w-full  md:w-[50%] justify-evenly  border border-amber-300 py-8 shadow-md bg-white rounded-md">
    <input type="text" 
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500  md:max-w-[60%] mb-4"
        placeholder="sector name " id="sector-input"> 
    <button class="text-white bg-gray-800  hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm  sm:w-auto px-5 py-1.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 h-10"
     id="addSector-button">Add Sector</button>
    </div>
            
    <div class="flex flex-col w-full  md:w-[50%]  border border-amber-300 px-5 py-8 mt-12">
      <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
          <div class="overflow-hidden">
            <table
            class="min-w-full text-left text-sm font-light text-surface dark:text-white" >
            <thead
                class="border-b border-neutral-200 font-medium dark:border-white/10">
                <tr>
                <th scope="col" class="px-6 py-4">No</th>
                <th scope="col" class="px-6 py-4">Sector code</th>
                <th scope="col" class="px-6 py-4">Sector Name</th>
                <th scope="col" class="px-6 py-4">Actions</th>
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
    $("#addSector-button").click(function(){
        addSectorInfo()
    })

function getSectorInfo(){
    const sector=document.getElementById("sector-section-table")

    
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
            const table1=`
            <tr class="border-b border-neutral-200 dark:border-white/10">
                <td class="whitespace-nowrap px-6 py-4 font-medium">${i}</td>
                <td class="whitespace-nowrap px-6 py-4">${response.SectorCode}</td>
                <td class="whitespace-nowrap px-6 py-4">${response.SectorName}</td>
                <td class="whitespace-nowrap px-6 py-4"><button class="btn btn-small btn-info">Edit</button></td>
                <td class="whitespace-nowrap px-6 py-4"><button class="btn btn-small btn-outline-danger">Delete</button></td>
            </tr>
            `

           sector.insertAdjacentHTML("beforeend",table1);
          
        })
        
        },
        error: function(xhr, status, error) {
            // Handle errors if needed
            console.error(error);
        }
    });
}







function formValue(){
   // alert("testttt")
let SectorName=document.getElementById("sector-input").value
const data={
    SectorName
}
return data
}

function addSectorInfo(){
           const formData =formValue();
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


</script>
@endsection


