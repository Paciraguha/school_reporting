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
<div class="container" style="padding-left:20px;padding-right:20px;margin:auto">
    <div class="w-full flex flex-col justify-center items-center mt-[50px] overflow-x-auto">
     
        <h3 class="py-2 border-b-2 border-red-900 my-4 w-full" id="table-title">
            {{ __("list of school staffs in sector") }}
        </h3>
        <table class="display text-left text-sm font-light text-surface dark:text-white" id="example" style="width:100%">
            <thead>
                <tr class="border border-slate-700">
                    <th class="px-6 py-4">No</th>
                    <th class="px-6 py-4">Date of Registration</th>
                    <th class="px-6 py-4"> Name</th>
                    <th class="px-6 py-4">email</th>
                    <th class="px-6 py-4">telephone</th>
                    <th class="px-6 py-4">School Code</th>
                    <th class="px-6 py-4">School Name</th>
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
                    b++
                    const table = `
            <tr class="border border-slate-700">
                <td class="whitespace-nowrap px-6 py-4 teacher-list-${elem.id}" >${b}</td>
                <td class="whitespace-nowrap px-6 py-4 teacher-list-${elem.id}">${elem.created_at.split("T")[0]}</td>
                <td class="whitespace-nowrap px-6 py-4 teacher-list-${elem.id}">${elem.firstName} ${elem.lastName}</td>
                <td class="whitespace-nowrap px-6 py-4 teacher-list-${elem.id}">${elem.email}</td>
                <td class="whitespace-nowrap px-6 py-4 teacher-list-${elem.id}">${elem.Telephone}</td>
                <td class="whitespace-nowrap px-6 py-4 teacher-list-${elem.id}">${elem.SchoolCode}</td>
                <td class="whitespace-nowrap px-6 py-4 teacher-list-${elem.id}">${elem.SchoolName}</td>
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