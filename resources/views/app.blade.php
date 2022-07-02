<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Omure Interview</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body class="antialiased">
<div class="relative flex flex-col items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center">
    <div class="min-w-600 mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div class="grid">
                <form id="weather_form">
                    <div class="overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6">
                                    <label for="city_name" class="block text-sm font-medium text-gray-700">City</label>
                                    <select id="city_name" name="city_name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                        @foreach(config('weather.city_names') as $cityName)
                                            <option value="{{$cityName}}">{{$cityName}}</option>
                                        @endforeach
                                    </select>
                                    <span class="error text-red-600"></span>
                                </div>

                                <div class="col-span-6">
                                    <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                                    <input type="date" name="date" id="date" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                    <span class="error text-red-600"></span>
                                </div>

                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="forecast_response" class="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-4 hidden">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div class="grid p-6">
                <table class="table-auto">
                    <thead>
                    <tr>
                        <th class="border px-4 py-2">City</th>
                        <th class="border px-4 py-2">Date</th>
                        <th class="border px-4 py-2">Temperature</th>
                        <th class="border px-4 py-2">Dew Point</th>
                        <th class="border px-4 py-2">Humidity</th>
                        <th class="border px-4 py-2">Wind Direction</th>
                        <th class="border px-4 py-2">Wind Speed</th>
                        <th class="border px-4 py-2">Wind Gust</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="border px-4 py-2">Intro to JavaScript</td>
                        <td class="border px-4 py-2">Chris</td>
                        <td class="border px-4 py-2">1,280</td>
                        <td class="border px-4 py-2">1,280</td>
                        <td class="border px-4 py-2">1,280</td>
                        <td class="border px-4 py-2">1,280</td>
                        <td class="border px-4 py-2">1,280</td>
                        <td class="border px-4 py-2">1,280</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function callApi(method, URL, payload) {
        return new Promise(function(resolve, reject) {
            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4) {
                    if(this.status === 200) {
                        resolve(JSON.parse(xhttp.responseText));
                    } else {
                        reject(JSON.parse(xhttp.responseText), xhttp.responseText);
                    }
                }
            };
            if(method.toLowerCase() === 'get') {
                URL = URL + '?'+new URLSearchParams(payload).toString();
            }
            xhttp.open(method, URL, true);
            xhttp.setRequestHeader('Accept', 'application/json');
            xhttp.send(payload);
        });
    }
    window.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('weather_form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(form);
            const errorFields = document.getElementsByClassName('error');
            for(const errorField of Object.keys(errorFields)) {
                errorFields[errorField].innerHTML = '';
            }

            callApi('GET', '/weather-data', {
                date: formData.get('date'),
                city_name: formData.get('city_name'),
            }).then(function(response) {
                if (response.data){
                    const tableBody = document.querySelector('#forecast_response table tbody');
                    tableBody.innerHTML = `<tr>
<td class="border px-4 py-2">${response.data.city}</td>
<td class="border px-4 py-2">${response.data.date}</td>
<td class="border px-4 py-2">${response.data.temperature}</td>
<td class="border px-4 py-2">${response.data.dew_point}</td>
<td class="border px-4 py-2">${response.data.humidity}</td>
<td class="border px-4 py-2">${response.data.wind_direction}</td>
<td class="border px-4 py-2">${response.data.wind_speed}</td>
<td class="border px-4 py-2">${response.data.wind_gust}</td>
</tr>`;
                    const responseElem = document.getElementById('forecast_response');
                    responseElem.classList.remove('hidden');
                }
            }).catch(function(error) {
                if(error.errors) {
                    for(const errorField of Object.keys(error.errors)) {
                        document.getElementsByName(errorField)[0].nextElementSibling.innerHTML = error.errors[errorField].join(' ');
                    }
                }
            });
        })
    });
</script>
</body>
</html>
