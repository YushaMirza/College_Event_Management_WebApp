
        const mobileMenu = document.querySelector('.mobile-menu');
        const navMenu = document.querySelector('nav ul');

        mobileMenu.addEventListener('click', () => {
            navMenu.classList.toggle('active');
        });
        
        const navLinks = document.querySelectorAll('nav ul li a');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                navMenu.classList.remove('active');
            });
        });
        
        const dateDisplay = document.querySelector('.date-display');
        const now = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        dateDisplay.textContent = now.toLocaleDateString('en-US', options);

        const searchInput = document.getElementById('searchInput');
        const table = document.getElementById('destinationsTable');
        const tableRows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
        
        searchInput.addEventListener('keyup', function() {
            const searchText = this.value.toLowerCase();
            
            for (let i = 0; i < tableRows.length; i++) {
                const row = tableRows[i];
                const cells = row.getElementsByTagName('td');
                let found = false;
                
                for (let j = 0; j < cells.length - 1; j++) { 
                    const cellText = cells[j].textContent.toLowerCase();
                    if (cellText.includes(searchText)) {
                        found = true;
                        break;
                    }
                }
                
                row.style.display = found ? '' : 'none';
            }
        });

        const filterSelect = document.getElementById('filterSelect');
        
        filterSelect.addEventListener('change', function() {
            const filterValue = this.value.toLowerCase();
            
            for (let i = 0; i < tableRows.length; i++) {
                const row = tableRows[i];
                const continentCell = row.getElementsByTagName('td')[3]; // Continent column
                
                if (filterValue === '' || continentCell.textContent.toLowerCase() === filterValue) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });

        const sortSelect = document.getElementById('sortSelect');
        const tableHeaders = table.getElementsByTagName('th');
        
        function clearSortIndicators() {
            for (let i = 0; i < tableHeaders.length; i++) {
                tableHeaders[i].classList.remove('sort-asc', 'sort-desc');
            }
        }
        
        sortSelect.addEventListener('change', function() {
            const sortValue = this.value;
            
            if (sortValue === '') return;
            
            let sortColumn, sortDirection;
            
            switch(sortValue) {
                case 'popularity-desc':
                    sortColumn = 4;
                    sortDirection = 'desc';
                    break;
                case 'popularity-asc':
                    sortColumn = 4;
                    sortDirection = 'asc';
                    break;
                case 'name-asc':
                    sortColumn = 1;
                    sortDirection = 'asc';
                    break;
                case 'name-desc':
                    sortColumn = 1;
                    sortDirection = 'desc';
                    break;
                default:
                    return;
            }
            
            clearSortIndicators();
            const rowsArray = Array.from(tableRows);
            
            rowsArray.sort((a, b) => {
                const aValue = a.getElementsByTagName('td')[sortColumn].textContent;
                const bValue = b.getElementsByTagName('td')[sortColumn].textContent;
                
                if (sortColumn === 4) {
                    const aStars = a.getElementsByTagName('td')[sortColumn].querySelector('.popularity-stars').children.length;
                    const bStars = b.getElementsByTagName('td')[sortColumn].querySelector('.popularity-stars').children.length;
                    
                    return sortDirection === 'asc' ? aStars - bStars : bStars - aStars;
                } else {
                    return sortDirection === 'asc' 
                        ? aValue.localeCompare(bValue) 
                        : bValue.localeCompare(aValue);
                }
            });
            
            while (tableRows.length > 0) {
                tableRows[0].parentNode.removeChild(tableRows[0]);
            }
            
            for (let row of rowsArray) {
                table.getElementsByTagName('tbody')[0].appendChild(row);
            }
            
            if (sortColumn === 4) {
                tableHeaders[sortColumn].classList.add(sortDirection === 'asc' ? 'sort-asc' : 'sort-desc');
            } else {
                tableHeaders[sortColumn].classList.add(sortDirection === 'asc' ? 'sort-desc' : 'sort-asc');
            }
        });

        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            header.classList.toggle('scrolled', window.scrollY > 50);
        });

        const destinationForm = document.getElementById('destinationForm');
        
        destinationForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // In a real application, this would send data to the server
            alert('Destination added successfully! This is a UI demo only.');
            destinationForm.reset();
        });

        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const row = this.closest('tr');
                const destinationName = row.getElementsByTagName('td')[1].textContent;
                
                if (confirm(`Are you sure you want to delete ${destinationName}?`)) {
                    row.remove();
                }
            });
        });
    