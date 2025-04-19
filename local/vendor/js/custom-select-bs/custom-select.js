"use strict";

/**
 * Copyright (c) 2021 Dmitry Prikhodko
 * Licensed under MIT (https://github.com/smugd/bootstrap-5-custom-select/blob/main/LICENSE)
 */

/**
 * @param {HTMLSelectElement} select
 * @param {string} activeClass
 */
function customSelect(select, activeClass = "bg-light") {

    //
    // Create dropdown menu
    //
    const dropdownButton = document.createElement("div");
    dropdownButton.setAttribute("data-bs-toggle", "dropdown");

    const dropdownMenu = document.createElement("ul");
    dropdownMenu.className = "dropdown-menu w-100";

    //
    // Create dropdown options from select and attach onclick listener on them
    //
    const onclick = (event) => {
        event.preventDefault();

        const option = event.target.closest(".dropdown-item"); // get clicked .dropdown-item

        select.value = option.dataset.value; // change selected value

        // remove .active class from every element in dropdown menu
        for (const active of dropdownMenu.getElementsByClassName(activeClass)) {
            active.classList.remove(activeClass);
        }
        // add .active class to selected option
        option.classList.add(activeClass);
    }

    for (const option of select.options) {

        // create .dropdown-item
        const a = document.createElement("a");
        a.className = "dropdown-item";
        a.dataset.value = option.value;
        a.onclick = onclick;
        a.href = '#';

        const span = document.createElement("span");
        span.innerText = option.text;
        span.style.paddingLeft = `${option.dataset.level}em`; // set indent depending on nest-level

        a.appendChild(span);

        // make .dropdown-item disabled
        if (option.disabled) {
            a.classList.add("disabled");
        }

        const li = document.createElement("li");
        li.appendChild(a);

        dropdownMenu.appendChild(li);
    }

    //
    // Wrap dropdown and select elements to relative positioned container
    //
    const container = document.createElement("div");
    container.className = "position-relative";

    select.parentElement.replaceChild(container, select);
    container.appendChild(select);
    container.appendChild(dropdownButton);
    container.appendChild(dropdownMenu);

    //
    // Initialize bootstrap's dropdown
    //
    const dropdown = new bootstrap.Dropdown(dropdownButton, { autoClose: true });

    //
    // Attach keyboard listeners
    //
    select.addEventListener("keypress", function(event) {
        switch (event.code) {
            case "Enter":
            case "Space":
                dropdown.toggle();
                event.preventDefault();
                break;
        }
    });

    //
    // Attach pointer listeners
    //
    select.addEventListener("pointerdown", function(event) {
        event.preventDefault(); // prevent select menu from open
        event.target.focus();
        dropdown.toggle();
    });

    select.addEventListener("click", function(event) {
        event.stopPropagation(); // do not dispatch click event (https://github.com/twbs/bootstrap/pull/33920)
    });

    //
    // Attach input listeners
    //
    select.addEventListener("change", function(event) {

        // remove .active class from every element in dropdown menu
        for (const active of dropdownMenu.getElementsByClassName(activeClass)) {
            active.classList.remove(activeClass);
        }
        // add .active class to selected option
        let selected = dropdownMenu.querySelector(`.dropdown-item[data-value="${this.value}"]`);
        if (selected) {
            selected.classList.add(activeClass);
        }
    });
}

for (const select of document.getElementsByClassName("custom-select")) {
    customSelect(select);
}
