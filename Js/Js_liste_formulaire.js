// Effet de scroll sur le header
const header = document.querySelector('.header');
window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});

// Animation des liens de navigation
const navLinks = document.querySelectorAll('.nav a');
navLinks.forEach(link => {
    link.addEventListener('mouseover', function(e) {
        this.style.transform = 'translateY(-2px)';
    });
    
    link.addEventListener('mouseout', function(e) {
        this.style.transform = 'translateY(0)';
    });
});

// Fonction de recherche
const searchInput = document.getElementById('searchInput');

if (searchInput) {
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const tableRows = document.querySelectorAll('tbody tr');
        
        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
}

// Fonction de pagination
document.addEventListener('DOMContentLoaded', function() {
    const itemsPerPage = 5;
    let currentPage = 1;
    let filteredRows = [];
    
    function filterTable(searchTerm) {
        const tableBody = document.querySelector('tbody');
        if (!tableBody) return;
        
        const rows = tableBody.querySelectorAll('tr');
        filteredRows = Array.from(rows).filter(row => {
            const text = row.textContent.toLowerCase();
            return text.includes(searchTerm.toLowerCase());
        });

        currentPage = 1; // Retour à la première page lors d'une recherche
        setupPagination();
    }
    
    function setupPagination() {
        const tableBody = document.querySelector('tbody');
        if (!tableBody) return;

        const rows = tableBody.querySelectorAll('tr');
        const rowsToUse = filteredRows.length > 0 ? filteredRows : Array.from(rows);
        const totalPages = Math.ceil(rowsToUse.length / itemsPerPage);

        // Masquer toutes les lignes d'abord
        rows.forEach(row => row.style.display = 'none');

        // Afficher uniquement les lignes filtrées pour la page actuelle
        rowsToUse.slice((currentPage - 1) * itemsPerPage, currentPage * itemsPerPage)
                 .forEach(row => row.style.display = '');

        // Mise à jour de la pagination
        let paginationContainer = document.querySelector('.pagination-container');
        if (!paginationContainer) {
            paginationContainer = document.createElement('div');
            paginationContainer.className = 'pagination-container';
            tableBody.parentNode.parentNode.insertAdjacentElement('afterend', paginationContainer);
        }

        paginationContainer.innerHTML = `
            <button class="pagination-arrow" id="prevPage" ${currentPage === 1 ? 'disabled' : ''}>
                <i class="fas fa-chevron-left"></i>
            </button>
            <span class="pagination-info">Page ${currentPage} sur ${totalPages}</span>
            <button class="pagination-arrow" id="nextPage" ${currentPage === totalPages ? 'disabled' : ''}>
                <i class="fas fa-chevron-right"></i>
            </button>
        `;

        // Gestionnaires d'événements pour les boutons
        document.getElementById('prevPage')?.addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                setupPagination();
            }
        });

        document.getElementById('nextPage')?.addEventListener('click', () => {
            if (currentPage < totalPages) {
                currentPage++;
                setupPagination();
            }
        });

        document.querySelector('tbody').classList.add('pagination-change');
        document.querySelector('tbody').addEventListener('animationend', function() {
            this.classList.remove('pagination-change');
        });
    }

    // Initialiser la pagination
    setupPagination();

    // Gestionnaire d'événements pour la recherche
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            filterTable(this.value);
        });
    }
}); 