@extends('layouts.teacherlayout')

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
   
                       

                        <table class="table" id="student-section-table">
                           <tr>
                                <td rowspan="2" class="px-6 py-4">No</td>
                                <td colspan='3' class="px-6 py-4"> Total Student</td>
                                <td colspan='4' class="px-6 py-4">Attendance Detail </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4"> Total</td>
                                <td class="px-6 py-4"> Male</td>
                                <td class="px-6 py-4">Female</td>
                                <td class="px-6 py-4">Attended Total</td>
                                <td class="px-6 py-4">Attended Male</td>
                                <td class="px-6 py-4">Attended Female</td>
                                <td class="px-6 py-4">Percentage</td>
                            </tr>
                        </table>
                   
  
</div>

<script>
 $(document).ready(function() {
    getAttendanceReport()
    $("#addHeadTeacher-button").click(function(){
        addNewHeadTeacher()
    })

})


function getAttendanceReport(){
    const schools=document.getElementById("student-section-table")
    $.ajax({
        type: 'GET',
        url: '{!! route('getStudentsAttendance') !!}',
        dataType: 'json',
        success: function(response) {
                console.log(response)
            const data=response;
            let i=0;
           // data.forEach((response)=>{
           
           // i++
            const table1=`
            <tr>
                <td class="whitespace-nowrap px-6 py-4">${i}</td>
                <td class="whitespace-nowrap px-6 py-4">${response.totalRegistered}</td>
                <td class="whitespace-nowrap px-6 py-4">${response.totalMale}</td>
                <td class="whitespace-nowrap px-6 py-4">${response.totalFemale}</td>
                <td class="whitespace-nowrap px-6 py-4">${response.attendedTotal}</td>
                <td class="whitespace-nowrap px-6 py-4">${response.attendedMale}</td>
                <td class="whitespace-nowrap px-6 py-4">${response.attendedFemale}</td>
                <td class="whitespace-nowrap px-6 py-4">${response.attendancePercentage}</td>
            </tr>
            `

           schools.insertAdjacentHTML("beforeend",table1);
          
      //  })
        
        },
        error: function(xhr, status, error) {
            // Handle errors if needed
            console.error(error);
        }
    });
}

</script>
@endsection


