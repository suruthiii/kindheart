let list = document.querySelectorAll(".sidenav .container .items .item, .sidenav .container .items .selected-item");

    function activeLink() {
        list.forEach((item) => {
            item.classList.remove("hovered", "bold");
            item.style.fontWeight = "normal"; // Reset font weight for all items
        });

        this.classList.add("hovered", "bold");
        this.style.fontWeight = "bold"; // Set font weight for the clicked item
    }

    list.forEach((item) => item.addEventListener("mouseover", activeLink));