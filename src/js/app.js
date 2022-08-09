let step = 1;
const BASE_URL = 'http://localhost:3000';
const appointment = {
  name: '',
  date: '',
  hour: '',
  services: [],
};

document.addEventListener('DOMContentLoaded', function () {
  app();
});

function app() {
  hideAllSections();
  showSection();
  tabs();
  showPaginatorButtons();
  goToPreviousSection();
  goToNextSection();
  getApiData();
  loadAppointmentData();
  showResume();
}

function hideAllSections() {
  const $sections = document.querySelectorAll('.section');
  $sections.forEach($section => {
    $section.classList.add('hide');
  });
}

function showSection() {
  const $sectionToShow = document.querySelector(`#step-${step}`);
  $sectionToShow.classList.remove('hide');
  $sectionToShow.classList.add('show');

  setActiveTab();
}

function tabs() {
  const $tabsButton = document.querySelectorAll('.tabs button');
  $tabsButton.forEach($button => {
    $button.addEventListener('click', e => {
      step = +e.target.dataset.step;
      hideAllSections();
      showSection();
      showPaginatorButtons();
    });
  });
}

function setActiveTab() {
  const $tabsButton = document.querySelectorAll('[data-step]');
  $tabsButton.forEach($button => {
    $button.classList.remove('active');
  });
  const $activeTab = document.querySelector(`[data-step='${step}']`);
  $activeTab.classList.add('active');
}

function showPaginatorButtons() {
  const $paginatorButtons = document.querySelectorAll('.paginator button');
  $paginatorButtons.forEach($button => {
    $button.classList.remove('hidden');
  });
  const $previousItemButton = document.querySelector('.paginator #prevItem');
  const $nextItemButton = document.querySelector('.paginator #nextItem');
  const $sections = document.querySelectorAll('.section');

  if (step === 1) $previousItemButton.classList.add('hidden');
  if (step === $sections.length) {
    $nextItemButton.classList.add('hidden');
    showResume();
  }
}

function goToPreviousSection() {
  const $previousItemButton = document.querySelector('.paginator #prevItem');
  $previousItemButton.addEventListener('click', () => {
    step--;
    hideAllSections();
    showSection();
    showPaginatorButtons();
  });
}

function goToNextSection() {
  const $nextItemButton = document.querySelector('.paginator #nextItem');
  $nextItemButton.addEventListener('click', () => {
    step++;
    hideAllSections();
    showSection();
    showPaginatorButtons();
  });
}

async function getApiData() {
  try {
    const url = `${BASE_URL}/api/servicios`;
    const result = await fetch(url);
    const data = await result.json();
    showServices(data);
  } catch (error) {
    console.log(error);
  }
}

function showServices(services = []) {
  services.forEach(service => {
    const { id, name, price } = service;

    const $serviceName = document.createElement('P');
    $serviceName.classList.add('serviceName');
    $serviceName.innerText = name;

    const $servicePrice = document.createElement('P');
    $servicePrice.classList.add('servicePrice');
    $servicePrice.innerText = `$${price}`;

    const $serviceDiv = document.createElement('DIV');
    $serviceDiv.classList.add('service');
    $serviceDiv.classList.add('textCenter');
    $serviceDiv.dataset.serviceId = id;
    $serviceDiv.onclick = () => selectService(service);

    $serviceDiv.appendChild($serviceName);
    $serviceDiv.appendChild($servicePrice);

    document.querySelector('#services').appendChild($serviceDiv);
  });
}

function selectService(service) {
  const { id } = service;
  const { services } = appointment;
  appointment.services = [...services, service];
  const $selectedService = document.querySelector(`[data-service-id='${id}']`);
  $selectedService.classList.toggle('selected');
}

function loadAppointmentData() {
  appointment.name = document.querySelector('#name').value;
  loadAppointmentDate();
  loadAppointmentHour();
}

function loadAppointmentDate() {
  const $inputDate = document.querySelector('#date');
  $inputDate.addEventListener('input', e => {
    const day = new Date(e.target.value).getUTCDay();

    if ([0, 6].includes(day)) {
      e.target.value = '';
      showAlert('error', 'No se puede agendar en fin de semana');
    } else {
      appointment.date = e.target.value;
    }
  });
}

function loadAppointmentHour() {
  const $inputHour = document.querySelector('#hour');
  $inputHour.addEventListener('input', e => {
    const appointmentHour = e.target.value;
    const hour = appointmentHour.split(':')[0];
    if (hour < 10 || hour > 18) {
      e.target.value = '';
      showAlert(
        'error',
        'Hora no valida, el horario de atención es de 10 a 18'
      );
    } else {
      appointment.hour = e.target.value;
    }
  });
}

function showResume() {
  const $resume = document.querySelector('.appointmentResume');
  while ($resume.firstChild) {
    $resume.removeChild($resume.firstChild);
  }

  if (
    Object.values(appointment).includes('') ||
    appointment.services.length === 0
  ) {
    showAlert(
      'error',
      'Hacen falta de servicios, fecha u hora',
      '.appointmentResume',
      false
    );
    return;
  }

  const { name, date, hour, services } = appointment;
  const formatedDate = formatDate(date);
  $resume.insertAdjacentHTML(
    'beforeend',
    `<h3 class='mb-1'>Resumen de la cita</h3>
    <div>
      <p><span>Nombre: </span>${name}</p>
      <p><span>Fecha: </span>${formatedDate}</p>
      <p><span>Hora: </span>${hour} horas</p>
    </div>
    <h3 class='mb-1 mt-2'>Resumen de servicios</h3>
    <div id='resumeContainer'></div>`
  );
  services.forEach(({ name, price }) => {
    document.getElementById('resumeContainer').insertAdjacentHTML(
      'afterbegin',
      `<div class='appointmentResume-service'>
        <p>${name}</p>
        <p><span>Precio: </span>$${price}</p>
      </div>`
    );
  });
  $resume.insertAdjacentHTML(
    'beforeend',
    `<button class='btn mb-2' onclick='bookAppointment()'>Reservar cita</button>`
  );
}

function formatDate(date) {
  const [day, month, year] = date.split('-');
  const options = {
    weekday: 'long',
    year: 'numeric',
    month: 'long',
    day: 'numeric',
  };
  return new Date(day, month - 1, year).toLocaleDateString('es-MX', options);
}

async function bookAppointment() {
  const { name, date, hour, services } = appointment;
  const idServices = services.map(({ id }) => id);

  const appointmentData = new FormData();
  appointmentData.append('name', name);
  appointmentData.append('date', date);
  appointmentData.append('hour', hour);
  appointmentData.append('services', idServices);

  const response = await fetch(`${BASE_URL}/api/citas`, {
    method: 'POST',
    body: appointmentData,
  });
  const data = await response.json();
  console.log(data);
}

function showAlert(type, message, reference = '.form', hasTimeout = true) {
  const $previousAlert = document.querySelector('.alert');
  if ($previousAlert) $previousAlert.remove();

  const $alert = document.createElement('DIV');
  $alert.classList.add('alert');
  $alert.classList.add(type);
  $alert.classList.add('mb-3');
  $alert.innerText = message;
  document.querySelector(reference).insertAdjacentElement('afterbegin', $alert);

  if (hasTimeout) {
    setTimeout(() => {
      $alert.remove();
    }, 3000);
  }
}
