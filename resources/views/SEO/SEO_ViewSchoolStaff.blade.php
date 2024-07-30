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
<div class="container" style="margin:auto">
    <div class="w-full flex flex-col justify-center items-center mt-[50px] overflow-x-auto">
     
        <h3 class="py-2 border-b-2 border-red-900 my-4 w-full" id="table-title">
            {{ __("list of school staffs in sector") }}
        </h3>
        <table class="display text-left text-sm font-light text-surface dark:text-white" id="example" style="width:100%">
            
                <thead>
                        <tr class="border">
                        <th rowspan="2" class="border">No</th>
                        <th class="px-2 py-2 border border-slate-300" colspan="7">Basic information at school</th>
                        <th class="px-2 py-2 border border-slate-300" colspan="4">Attendance statistic</th>
                        <th  class="px-2 py-2 border border-slate-300">Actions</th>
                        </tr>
                        <tr>
                            <th class="px-2 py-2 border border-slate-300">Date of Registration</th>
                            <th class="px-2 py-2 border border-slate-300"> Name</th>
                            <th class="px-2 py-2 border border-slate-300">Email</th>
                            <th class="px-2 py-2 border border-slate-300">Telephone</th>
                            <th class="px-2 py-2 border border-slate-300">Position</th>
                            <th class="px-2 py-2 border border-slate-300">School Code</th>
                            <th class="px-2 py-2 border border-slate-300">School Name</th>
                            <th class="px-2 py-2 border border-slate-300">Total</th>
                            <th class="px-2 py-2 border border-slate-300">Present</th>
                            <th class="px-2 py-2 border border-slate-300">Absent</th>
                            <th class="px-2 py-2 border border-slate-300">%</th>
                            <th class="px-2 py-2 border border-slate-300">Teacher Attendance</th>
                        </tr>
                </thead>
        
            <tbody id="teacher-section-table">
            </tbody>
        </table>
    </div>

    <script>
    const token = localStorage.getItem('auth_token');
    $(document).ready(function() {

        getAllHeadTeacher()

        // $('button.showData').click(function() {

        //     const trElement = document.querySelectorAll(".tr-data")
        //     console.log("ggggggg", trElement.length)
        //     trElement.forEach(element => {
        //         element.remove()
        //     });
        // })

    });






    function getAllHeadTeacher(id) {
        // document.getElementById("table-title").innerText=`List of  ${id.HeadTeacher} in districts`;
        const schoolTeachers = document.getElementById("teacher-section-table")
        $.ajax({
            type: 'GET',
            url: '{!! route('SEO_StaffInSector') !!}',
            headers: {
                'Authorization': 'Bearer ' + token,
                "Content-Type": "application/json"
            },
            dataType: 'json',
            success: function(response) {
                const data = response;
                console.log("hhhhhhhhh", data)
                let b = 0;
                data.forEach((elem) => {
                    const percentage=Number(Math.round(elem.totalPresent*100 / elem.totalRegistered))
                    b++
                    const table = `
            <tr class="border border-slate-700">
                <td class="px-2 py-2 border border-slate-300" >${b}</td>
                <td class="px-2 py-2 border border-slate-300">${elem.created_at.split("T")[0]}</td>
                <td class="px-2 py-2 border border-slate-300">${elem.firstName} ${elem.lastName}</td>
                <td class="px-2 py-2 border border-slate-300">${elem.email}</td>
                <td class="px-2 py-2 border border-slate-300">${elem.Telephone}</td>
                 <td class="px-2 py-2 border border-slate-300">${elem.position}</td>
                <td class="px-2 py-2 border border-slate-300">${elem.SchoolCode}</td>
                <td class="px-2 py-2 border border-slate-300">${elem.SchoolName}</td>
                <td class="px-2 py-2 border border-slate-300">${elem.totalRegistered}</td>
                <td class="px-2 py-2 border border-slate-300">${elem.totalPresent}</td>
                <td class="px-2 py-2 border border-slate-300">${elem.totalAbsent}</td>
                <td class="px-2 py-2 border border-slate-300">${percentage}</td>
                <td class="px-2 py-2 border border-slate-300">
                    <a href="/SEO-teacherAttendanceDetail/${elem.id}"  class="btn btn-success">Attendance</a>
                </td>
            </tr>`
                    schoolTeachers.insertAdjacentHTML("beforeend", table);
                })
                dataTable()
            },
            error: function(xhr, status, error) {
                // Handle errors if needed
                console.error(error);
            }
        });
    }


    function dataTable() {
        return new DataTable('#example', {
            columnDefs: [{
                    targets: [0],
                    orderData: [0, 1]
                },
                {
                    targets: [1],
                    orderData: [1, 0]
                },
                {
                    targets: [4],
                    orderData: [4, 0]
                }
            ]
        });

    }
    </script>
    @endsection