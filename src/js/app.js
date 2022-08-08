let step = 1;

document.addEventListener('DOMContentLoaded', function () {
  app();
});

function app() {
  hideAllSections();
  showSection();
  tabs();
}

function hideAllSections() {
  const $sections = document.querySelectorAll('.section');
  $sections.forEach($section => {
    $section.classList.add('hide');
  });
}

function showSection() {
  hideAllSections();

  const $sectionToShow = document.querySelector(`#step-${step}`);
  $sectionToShow.classList.remove('hide');
  $sectionToShow.classList.add('show');

  setActiveTab();
}

function tabs() {
  const $tabsButton = document.querySelectorAll('.tabs button');
  $tabsButton.forEach($button => {
    $button.addEventListener('click', e => {
      step = e.target.dataset.step;
      showSection();
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
