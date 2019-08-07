"use strict";

Drupal.behaviors.appCredentialProductList = {
  isSetUp: false,
  attach: function (context, drupalSettings) {
    if (this.isSetUp) {
      return;
    }

    var hidden = 'app-cred-prod-list--element-hidden';
    var hiddenList = document.getElementById('app-cred-prod-hidden-list');
    var showMore = document.getElementById('app-cred-prod-list-show-more');
    var showLess = document.getElementById('app-cred-prod-list-show-less');
    showMore.addEventListener('click', function () {
      this.classList.add(hidden);
      showLess.classList.remove(hidden);
      hiddenList.classList.remove(hidden);
    });
    showLess.addEventListener('click', function () {
      this.classList.add(hidden);
      showMore.classList.remove(hidden);
      hiddenList.classList.add(hidden);
    });

    this.isSetUp = true;
  }
};
