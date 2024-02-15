<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <input type="text" id="iconFilter" class="form-control" placeholder="Type to filter icons...">
        </div>
    </div>
    <div class="row" id="iconContainer">
        <!-- Icons will be dynamically inserted here -->
    </div>
</div>


<script>
    // Detect all icons used on page
    document.addEventListener('DOMContentLoaded', function () {
        const iconContainer = document.getElementById('iconContainer');

        function detectAndDisplayIcons() {
            const iconPrefixes = ['bi-', 'fa-', 'fas ', 'far ', 'fal ', 'fad ']; // Icon class prefixes
            const allElements = document.querySelectorAll('*'); // Get all elements in the DOM
            const detectedIcons = new Set();

            allElements.forEach(el => {
                if (el.className) {
                    const classList = el.className.toString().split(/\s+/); // Handle both string and SVGAnimatedString
                    classList.forEach(cls => {
                        iconPrefixes.forEach(prefix => {
                            if (cls.startsWith(prefix) && !detectedIcons.has(cls)) {
                                detectedIcons.add(cls);
                                displayIcon(cls); // Display each detected icon
                            }
                        });
                    });
                }
            });
        }

        function displayIcon(iconClass) {
            const iconDiv = document.createElement('div');
            iconDiv.className = `col-6 col-md-4 col-lg-3 text-center my-2`;

            const iconElement = document.createElement('i');
            iconElement.className = `${iconClass}`;
            iconDiv.appendChild(iconElement);

            const iconText = document.createElement('p');
            iconText.textContent = iconClass;
            iconDiv.appendChild(iconText);

            iconContainer.appendChild(iconDiv);
        }

        function filterIcons() {
            const filterValue = document.getElementById('iconFilter').value.toLowerCase();
            const icons = iconContainer.querySelectorAll('.col-6');

            icons.forEach(icon => {
                const iconName = icon.textContent.toLowerCase();
                icon.style.display = iconName.includes(filterValue) ? "" : "none";
            });
        }

        // Setup filter listener
        document.getElementById('iconFilter').addEventListener('keyup', filterIcons);

        // Initial detection and display of icons
        detectAndDisplayIcons();
    });
</script>
