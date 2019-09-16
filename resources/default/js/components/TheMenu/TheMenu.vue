<template>
  <ul>
    <li>
      <a href="#">
        <img src="https://image.flaticon.com/icons/svg/263/263115.svg" width="20" height="20" alt>
        <span>Home</span>
      </a>
    </li>
    <li class="selected">
      <a class="toggle" href="#example">
        <img src="https://image.flaticon.com/icons/svg/263/263078.svg" width="20" height="20" alt>
        <span>Billing</span>
        <img
          src="https://image.flaticon.com/icons/svg/566/566015.svg"
          width="12"
          height="12"
          alt
          class="chevron"
        >
      </a>
      <div class="toggle-content" id="example">
        <ul>
          <li>
            <a href="#">Monthly Bill</a>
          </li>
          <li>
            <a href="#">Pay History</a>
          </li>
        </ul>
      </div>
    </li>
    <li>
      <a href="#">
        <img src="https://image.flaticon.com/icons/svg/263/263058.svg" width="20" height="20" alt>
        <span>Employees</span>
      </a>
    </li>
    <li>
      <a href="#">
        <img src="https://image.flaticon.com/icons/svg/263/263146.svg" width="20" height="20" alt>
        <span>Claims</span>
      </a>
    </li>
    <li>
      <a href="#">
        <img src="https://image.flaticon.com/icons/svg/263/263122.svg" width="20" height="20" alt>
        <span>My Plans</span>
      </a>
    </li>
  </ul>
</template>

<script>
export default {
  name: "TheMenu",
  mounted() {
    // Show an element
    var show = function(elem) {
      // Get the natural height of the element
      var getHeight = function() {
        elem.style.display = "block"; // Make it visible
        var height = elem.scrollHeight + "px"; // Get it's height
        elem.style.display = ""; //  Hide it again
        return height;
      };

      var height = getHeight(); // Get the natural height
      elem.classList.add("is-visible"); // Make the element visible
      elem.style.height = height; // Update the max-height

      // Once the transition is complete, remove the inline max-height so the content can scale responsively
      window.setTimeout(function() {
        elem.style.height = "";
      }, 350);
    };

    // Hide an element
    var hide = function(elem) {
      // Give the element a height to change from
      elem.style.height = elem.scrollHeight + "px";

      // Set the height back to 0
      window.setTimeout(function() {
        elem.style.height = "0";
        console.log("window.setTimeout");
      }, 1);

      // When the transition is complete, hide it
      window.setTimeout(function() {
        elem.classList.remove("is-visible");
        console.log("window.setTimeout:remove is-visible");
      }, 300);
    };

    // Toggle element visibility
    var toggle = function(elem, timing) {
      // If the element is visible, hide it
      if (elem.classList.contains("is-visible")) {
        hide(elem);
        return;
        console.log("hide element");
      }

      // Otherwise, show it
      show(elem);
      console.log("show element");
    };

    // Listen for click events
    document.addEventListener(
      "click",
      function(event) {
        // Make sure clicked element is our toggle
        if (!event.target.closest("a").classList.contains("toggle")) {
          return;
        }

        // Prevent default link behavior
        event.preventDefault();

        // Get the content
        console.log(event.target.closest("a").hash);
        var content = document.querySelector(event.target.closest("a").hash);
        if (!content) return;

        // Toggle the content
        toggle(content);
      },
      false
    );
  }
};
</script>

<style>
.toggle {
  border-left: 5px solid #015295;
  padding-left: calc(1.5rem - 5px);
}

.toggle-content {
  display: none;
  height: 0;
  overflow: hidden;
  transition: height 0.3s ease-in-out;
}

.toggle-content.is-visible {
  display: block;
  height: auto;
}
</style>


