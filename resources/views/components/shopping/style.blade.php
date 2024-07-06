{{-- Codigo CSS --}}
<style>
    .container-scroll {
        background: #ddd;
        max-width: 900px;
        border-radius: 30px;
        overflow: hidden;
        position: relative;
    }

    .container-scroll i {
        width: 40px;
        height: 40px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #333;
        border-radius: 50%;
        pointer-events: auto;
    }

    .container-scroll i:hover {
        background: var(--background);
        color: #fff;
    }

    .container-scroll ul {
        display: flex;
        gap: 16px;
        padding: 12px 24px;
        margin: 0;
        list-style: none;
        overflow-x: scroll;
        scrollbar-width: none;
        scroll-behavior: smooth;
    }

    .container-scroll ul.dragging {
        scroll-behavior: auto;
    }

    .container-scroll ul::-webkit-scrollbar {
        display: none;
    }

    .container-scroll button {
        color: #333;
        font-weight: 500;
        background: #fff;
        padding: 4px 24px;
        border-radius: 30px;
        transition: background 0.3s, color 0.3s;
        border: none;
        cursor: pointer;
    }

    .container-scroll button:hover,
    .container-scroll button.active {
        background: var(--background);
        color: #fff;
    }

    .iconChevron-left,
    .iconChevron-right {
        position: absolute;
        height: 100%;
        width: 100px;
        top: 0;
        display: none;
        align-items: center;
        pointer-events: none;
    }

    .iconChevron-left.active,
    .iconChevron-right.active {
        display: flex;
    }

    .iconChevron-right {
        right: 0;
        background: linear-gradient(to left, #ddd 50%, transparent);
        justify-content: flex-end;
    }

    .iconChevron-left {
        background: linear-gradient(to right, #ddd 50%, transparent);
    }
</style>

{{-- Codigo JS --}}
<script>
        document.addEventListener("DOMContentLoaded", () => {
        const tabs = document.querySelectorAll(".container-scroll button");
        const rightArrow = document.querySelector(".container-scroll .iconChevron-right i");
        const leftArrow = document.querySelector(".container-scroll .iconChevron-left i");
        const tabsList = document.querySelector(".container-scroll ul");
        const leftArrowContainer = document.querySelector(".container-scroll .iconChevron-left");
        const rightArrowContainer = document.querySelector(".container-scroll .iconChevron-right");

        const removeAllActiveClasse = () => tabs.forEach(tab => tab.classList.remove("active"));

        tabs.forEach(tab => {
            tab.addEventListener("click", () => {
                removeAllActiveClasse();
                tab.classList.add("active");
            });
        });

        const manageIcons = () => {
            leftArrowContainer.classList.toggle("active", tabsList.scrollLeft >= 20);
            const maxScrollValue = tabsList.scrollWidth - tabsList.clientWidth - 20;
            rightArrowContainer.classList.toggle("active", tabsList.scrollLeft < maxScrollValue);
        };

        rightArrow.addEventListener("click", () => {
            tabsList.scrollLeft += 200;
            manageIcons();
        });

        leftArrow.addEventListener("click", () => {
            tabsList.scrollLeft -= 200;
            manageIcons();
        });

        tabsList.addEventListener("scroll", manageIcons);

        let dragging = false;

        tabsList.addEventListener("mousemove", (e) => {
            if (!dragging) return;
            tabsList.classList.add("dragging");
            tabsList.scrollLeft -= e.movementX;
        });

        tabsList.addEventListener("mousedown", () => dragging = true);
        document.addEventListener("mouseup", () => {
            dragging = false;
            tabsList.classList.remove("dragging");
        });
    });
</script>