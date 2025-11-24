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
    this.closebanner = document.querySelector(".close-btn");
  }

  closeBanner() {
    this.bannerAdd.style.display = "none";
  }

  addEventListeners() {
    if (this.closebanner) {
      this.closebanner.addEventListener("click", () => this.closeBanner());
    }
  }
}

const modal = new Modal();
modal.addEventListeners();

const notification = new BannerNotification();
notification.addEventListeners();
