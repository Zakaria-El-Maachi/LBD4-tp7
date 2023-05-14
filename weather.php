<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather</title>
</head>

<body onload="listCountries()">
    <h2>Weather App</h2>
    <input type="text" id="city" name="city">
    <button onclick="search()">Submit</button>
    <div id="output" style="margin-top:20px; width:fit-content; border-radius:10px; border:1px solid black;"></div>

    <br><br><br>

    <h2>Pseudo Connection</h2>
    <div style="display:flex; align-items:center; column-gap:20px;">
        <input type="text" id="pseudo" onkeyup="pseudo(this.value)">
        <textarea id="message" cols="20" rows="3"></textarea>
    </div>

    <br><br><br>

    <h2>Country Information</h2>
    <select id="countrylist" style="width:150px;"></select>
    <div id="countryinfo" style="margin-top:20px; width:fit-content; border-radius:10px; border:1px solid black;"></div>

    <br><br><br>

    <h2>Vol</h2>
    <label for="volcity">From : </label>
    <input type="text" id="volcity">
    <label for="volcity2">To : </label>
    <input type="text" id="volcity2">
    <label for="date">Date : </label>
    <input type="date" id="date">
    <button onclick="vol()">Search</button>
    <div id="vols" style="margin-top:20px; width:fit-content; border-radius:10px; border:1px solid black;"></div>

    <br><br><br>

    <h2>Image Search</h2>
    <textarea name="" id="imageSearch" cols="20" rows="7"></textarea>
    <button onclick="image()">Submit</button>
    <div id="outputImages" style="display:flex; align-items:center; justify-content:space-around; width:700px; flex-wrap: wrap; margin:auto;"></div>

    <script>
        function parsedweather(txt) {
            let js = JSON.parse(txt);
            return `<b>Weather : </b>${js.weather[0].description}<br>
            <b>Temperature : </b>${js.main.temp - 273.15} C<br>
            <b>Humidity : </b>${js.main.humidity} %<br>
            <b>Wind : </b>${js.wind.speed} m/s<br>
            <b>Cloudiness : </b>${js.clouds.all} %<br>`;
        }

        function parsedcountry(txt) {
            let js = JSON.parse(txt);
            return `<b>Continent : </b>${js.Continent}<br>
            <b>Region : </b>${js.Region}<br>
            <b>Surface Area : </b>${js.SurfaceArea} km<br>
            <b>Population : </b>${js.Population}<br>
            <b>Life Expectancy : </b>${js.LifeExpectancy} Yrs<br>
            <b>Capital : </b>${js.Name}<br>
            <b>Head of State : </b>${js.HeadOfState}<br>`;
        }

        function search() {
            let city = document.getElementById("city").value;
            let xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("output").innerHTML = parsedweather(this.responseText);
                }
            };
            xhr.open("GET", `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=ca391abd27c9f3dc4ff67a87b5d94057`);
            xhr.send();
        }

        function pseudo(ps) {
            let ms = document.getElementById("message");
            if (ps.length < 5) {
                ms.style["border-color"] = "red";
                ms.value = "The pseudo is at least 5 characters long";
            } else {
                ms.style["border-color"] = "black";
                ms.value = "";
                let xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        ms.value = this.responseText;
                    }
                };
                xhr.open("POST", "pseudohandler.php");
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send("pseudo=" + ps);
            }
        }
        const listing = document.getElementById("countrylist");

        function listCountries() {
            let xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let js = this.responseText.split(',');
                    for (let i = 0; i < js.length; i++) {
                        let op = document.createElement("option");
                        op.text = js[i];
                        op.value = js[i];
                        listing.appendChild(op);
                    }
                }
            }
            xhr.open("GET", "countries.php?go=0");
            xhr.send();
        }

        listing.addEventListener("change", (event) => {
            let xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("countryinfo").innerHTML = parsedcountry(this.responseText);
                }
            }
            xhr.open("GET", "countries.php?go=1&country=" + event.target.value);
            xhr.send();
        });

        function vol() {
            const api_key = 'your_api_key';
            const departure_city = document.getElementById("volcity");
            const arrival_city = document.getElementById("volcity2");
            const departure_date = document.getElementById("date");

            fetch(`http://api.aviationstack.com/v1/cities?access_key=49838cdcc1d6a6936c966532c162f035&search=${departure_city}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    const departure_iata = data.data[0].iata_code;

                    fetch(`http://api.aviationstack.com/v1/cities?access_key=49838cdcc1d6a6936c966532c162f035&search=${arrival_city}`)
                        .then(response => response.json())
                        .then(data => {
                            const arrival_iata = data.data[0].iata_code;

                            fetch(`http://api.aviationstack.com/v1/flights?access_key=49838cdcc1d6a6936c966532c162f035&dep_iata=${departure_iata}&arr_iata=${arrival_iata}&flight_date=${departure_date}`)
                                .then(response => response.json())
                                .then(data => {
                                    console.log(data);
                                })
                                .catch(error => {
                                    console.error('Error fetching flight schedules:', error);
                                });
                        })
                        .catch(error => {
                            console.error('Error fetching arrival city:', error);
                        });
                })
                .catch(error => {
                    console.error('Error fetching departure city:', error);
                });

        }

        function image() {
            const apiKey = '1692be50017f0a8dc7021cb33a5073eb';
            const searchText = document.getElementById("imageSearch").value;
            const apiUrl = `https://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=${apiKey}&text=${searchText}&format=json&nojsoncallback=1`;

            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    const photos = data.photos.photo.slice(0, 19);
                    photos.forEach(photo => {
                        let img = document.createElement("img");
                        img.src = `https://live.staticflickr.com/${photo.server}/${photo.id}_${photo.secret}_w.jpg`;
                        img.style.width = "150px";
                        document.getElementById("outputImages").appendChild(img);
                    });
                });
        }
    </script>

</body>

</html>