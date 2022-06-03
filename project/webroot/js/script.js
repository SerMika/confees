var center = { lat: 49.0, lng: 32.0 }; //Координаты для центра карты и маркера
var latInp = document.getElementById("lat"); //Элемент для широты в формах
var lngInp = document.getElementById("lng"); //Элемент для долготы в формах

//Функция для изменения центра
function setCenter(lat, lng) {
  center = { lat: lat, lng: lng };
}

//Функция для отображения карты на странице показа информации конференции
function loadMap() {
  //Создание карты
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 7,
    center: center,
  });

  //Создание маркера
  const marker = new google.maps.Marker({
    position: center,
    map: map,
  });
}

//Функция для отображения карты на странице создания конференции
function loadMapCreate() {
  //Создание карты
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 7,
    center: center,
  });

  //Создание маркера
  var marker = new google.maps.Marker({
    position: center,
    map: map,
    draggable: true, //Разрешаем перемещение маркера
  });

  //Чекбокс отображения адреса
  var addressCheck = document.getElementsByName("addressIsSet")[0];

  setMarkerVisibiltiy();

  //var geocoder = new google.maps.Geocoder();
  //Действия при перемещении
  google.maps.event.addListener(marker, "dragend", function (event) {
    placeMarker(event.latLng);
    setMarkerVisibiltiy();
    //Получение адреса с помощью Geocoder. Нужна подписка!
    /*geocoder.geocode({ latLng: event.latLng }, function (results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        console.log(results[0].formatted_address); //адрес новой точки
      }
    });
    */
  });
  //Действия при клике на карту
  google.maps.event.addListener(map, "click", function (event) {
    placeMarker(event.latLng);
    setMarkerVisibiltiy();
    /*geocoder.geocode({ latLng: event.latLng }, function (results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        console.log(results[0].formatted_address); //адрес новой точки
      }
    });
    */
  });

  //Каждый раз при клике на чекбокс включаем либо выключаем маркер и обновляем поля долготы и широты
  addressCheck.addEventListener("click", (event) => {
    setMarkerVisibiltiy();
    setLatLngInForms();
  });

  latInp.addEventListener("change", (event) => {
    if (!latInp.value && !lngInp.value) {
      disableAddress();
      addressCheck.checked = false;
      marker.setVisible(false);
    } else marker.setVisible(true);
    latLng = new google.maps.LatLng(latInp.value, center.lng);
    marker.setPosition(latLng);
  });

  lngInp.addEventListener("change", (event) => {
    if (!latInp.value && !lngInp.value) {
      disableAddress();
      addressCheck.checked = false;
      marker.setVisible(false);
    } else marker.setVisible(true);
    latLng = new google.maps.LatLng(center.lat, lngInp.value);
    marker.setPosition(latLng);
  });

  //Перемещаем маркер в новое положение
  function placeMarker(location) {
    if (marker) {
      marker.setPosition(location);
    } else {
      marker = new google.maps.Marker({
        position: location,
        map: map,
      });
    }
    //Обновляем центр
    center = {
      lat: location.lat().toFixed(5),
      lng: location.lng().toFixed(5),
    };

    if (addressCheck.checked) {
      setLatLngInForms();
    }
  }

  //Вспомогательная функция для обновления полей долготы и широты в формах
  function setLatLngInForms() {
    latInp.value = center.lat;
    lngInp.value = center.lng;
  }

  //Вспомогательная функция для отображения либо скрытия маркера
  function setMarkerVisibiltiy() {
    if (addressCheck.checked) {
      marker.setVisible(true);
    } else {
      marker.setVisible(false);
    }
  }
}

//Функция для изменения id кнопки отправки формы
function changeButtonValue(id) {
  button = document.getElementsByName("buttonDelete")[0];
  button.value = id;
}

//Фукнция для отключения либо включения полей ввода долготы и широты в формах
function disableAddress() {
  if (latInp.hasAttribute("disabled")) {
    latInp.removeAttribute("disabled");
    lngInp.removeAttribute("disabled");
  } else {
    latInp.setAttribute("disabled", "disabled");
    lngInp.setAttribute("disabled", "disabled");
  }
}

//
function validate() {
  const submit = document.getElementById("submit");

  submit.addEventListener("click", function (event) {
    var title = document.getElementById("title");
    var date = document.getElementsByName("date")[0];
    curDate = new Date();

    if (title.value.length < 2) {
      title.setCustomValidity("Название должно содержать не менее 2 символов");
      event.preventDefault();
    } else {
      title.setCustomValidity("");
    }

    title.reportValidity();

    if (new Date(date.value).getTime() < curDate.getTime()) {
      date.setCustomValidity("Введите, пожалуйста, будущую дату");
      event.preventDefault();
    } else {
      date.setCustomValidity("");
    }

    date.reportValidity();
  });
}


function selectDefaultOption(value) {
  select = document.getElementById("select").options;

  option = Array.apply(null, select).filter((op) => op.value == value);
  defaultOption = document.getElementById(option[0].id);
  defaultOption.setAttribute("selected", "selected");
}
