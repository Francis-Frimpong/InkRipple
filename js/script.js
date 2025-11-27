// Modal class
class Modal {
  constructor() {
    this.deleteBtn = document.querySelector(".delete-btn");
    this.cancelBtn = document.querySelector(".cancel-btn");
    this.modalOverlay = document.getElementById("modal");
  }

  displayModal() {
    this.modalOverlay.style.display = "flex";
  }
  cancel() {
    this.modalOverlay.style.display = "none";
  }

  addEventListeners() {
    if (this.cancelBtn) {
      this.cancelBtn.addEventListener("click", () => this.cancel());
    }

    if (this.deleteBtn) {
      this.deleteBtn.addEventListener("click", () => this.displayModal());
    }
  }
}

// Notification class
class BannerNotification {
  constructor() {
    this.alertBox = document.querySelector(".alert"); // whole alert
    this.closeBtn = document.querySelector(".alert-close"); // the X button
  }

  closeAlert() {
    if (this.alertBox) {
      this.alertBox.style.display = "none";
    }
  }

  addEventListeners() {
    if (this.closeBtn) {
      this.closeBtn.addEventListener("click", () => this.closeAlert());
    }
  }
}

document.addEventListener("DOMContentLoaded", () => {
  const modal = new Modal();
  modal.addEventListeners();

  const notification = new BannerNotification();
  notification.addEventListeners();
});
