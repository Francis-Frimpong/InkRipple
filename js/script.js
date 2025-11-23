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
    this.cancelBtn.addEventListener("click", () => this.cancel());
    this.deleteBtn.addEventListener("click", () => this.displayModal());
  }
}

class Notification {
  constructor() {}
}

const modal = new Modal();
modal.addEventListeners();
