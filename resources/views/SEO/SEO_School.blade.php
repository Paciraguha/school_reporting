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
<div class="container" style="padding-left:20px;padding-right:20px;margin-right:50px;margin:auto">

    <div class="flex flex-col w-full  md:w-[100%] border border-amber-300 px-1 py-8 mt-10">
        <div class="overflow-x-auto sm:-mx-6 mx-auto w-[100%]">
            <div class="inline-block py-2 sm:px-1 lg:px-4 w-full">

                <h3 class="py-2 border-b-2 border-red-900 my-4">
                    {{ __("list of schools in sector") }}
                </h3>
                <div>
                    <table class="min-w-full text-left text-sm font-light text-surface dark:text-white"
                        id="school-section-table">
                        <thead class="border-b border-neutral-200 font-medium dark:border-white/10">
                            <tr>
                                <td rowspan="2" class="px-6 py-4">No</td>
                                <td rowspan="2" class="px-6 py-4">Date of Registration</td>
                                <td class="px-6 py-4"> Sector Code</td>
                                <td class="px-6 py-4"> School Code</td>
                                <td class="px-6 py-4">School Name</td>
                                <td class="px-6 py-4">School Levels</td>
                                <td colspan="3" class="px-6 py-4">Actions</td>
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
        getAllSchool()
        getClassLevels()
     
        function getClassLevels() {
            const school_levels = document.getElementById("school-levels")
            $.ajax({
                type: 'GET',
                url: '{!! route('getClassLevels') !!}',
                headers: {
                    'Authorization': 'Bearer ' + token,
                },
                dataType: 'json',
                success: function(response) {
                    const data = response;
                    let i = 0;
                    data.forEach((response) => {
                        console.log(response)
                        i++
                        const options = `
                         <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="${response.levels}" name="classLevel[]" type="checkbox" value="${response.id}" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 school-level" required />
                            </div>
                            <label for="${response.levels}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">${response.levels}</label>
                        </div>
            `
                        school_levels.insertAdjacentHTML("beforeend", options);
                    })

                },
                error: function(xhr, status, error) {
                    // Handle errors if needed
                    console.log(error);
                }
            });
        }


        function getAllSchool() {
            const schools = document.getElementById("school-section-table")

            $.ajax({
                type: 'GET',
                url: '{!! route('getAllSchools') !!}',
                headers: {
                    'Authorization': 'Bearer ' + token

                },
                dataType: 'json',
                success: function(response) {

                    const data = response;
                    console.log("--------------------------------------hhhhhh",data)
                    let i = 0;
                    data.forEach((response) => {
                        let levels = [];
                        console.log(response.SchoolLevels)
                        const lev = response.SchoolLevels
                        lev.forEach(element => {
                            levels.push(element.levels)
                        });
                        i++
                        let result = levels.join(", ");
                        const table1 = `
            <tr class="border-b border-neutral-200 dark:border-white/10 tr-data">
                <td class="whitespace-nowrap px-6 py-4">${i}</td>
                <td class="whitespace-nowrap px-6 py-4">${response.created_at.split("T")[0]}</td>
                <td class="whitespace-nowrap px-6 py-4">${response.SectorCode}</td>
                <td class="whitespace-nowrap px-6 py-4">${response.SchoolCode}</td>
                <td class="whitespace-nowrap px-6 py-4">${response.SchoolName}</td>
                <td class="whitespace-nowrap px-6 py-4">${result}</td>
                <td class="whitespace-nowrap px-6 py-4"> <a href="/SEO-SchoolDailyAttendance/${response.id}" class="btn btn-primary">Daily Attendance</a></td>
                <td class="whitespace-nowrap px-6 py-4"><a href="/SEO-SchoolsAttendance/${response.id}" class="btn btn-success">Student</a></td>
                <td class="whitespace-nowrap px-6 py-4"><a href="/SEO-StaffBySchool/${response.id}" class="btn btn-warning">Staff</a></td>
            </tr>
            `

                        schools.insertAdjacentHTML("beforeend", table1);

                    })

                },
                error: function(xhr, status, error) {
                    // Handle errors if needed
                    console.log(error);
                }
            });
        }







    })
    </script>
    @endsection