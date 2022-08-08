let step = 1;
const BASE_URL = 'http://localhost:3000';

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
  if (step === $sections.length) $nextItemButton.classList.add('hidden');
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
  services.forEach(({ id, name, price }) => {
    document.querySelector('#services').insertAdjacentHTML(
      'beforeend',
      `<div class="service textCenter" data-service-id="${id}">
        <p class="serviceName">${name}</p>
        <p class="servicePrice">$${price}</p>
      </div>`
    );
  });
}
