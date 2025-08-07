<div class="bg-white rounded-lg shadow overflow-hidden">
    <!-- Header Section -->
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
        <h2 class="text-lg font-semibold text-gray-800">Daftar Alumni</h2>
        <div class="flex space-x-2">
            <input type="search" id="searchInput" placeholder="Cari alumni..."
                class="px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            <select id="yearFilter" class="px-4 py-2 border border-gray-300 rounded-md">
                <option value="">Semua Tahun</option>
                @foreach ($uniqueYears as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Table Container -->
    <div class="overflow-x-auto">
        <table id="alumniTable" class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer sortable"
                        data-column="nama">
                        Nama <span class="sort-icon"></span>
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer sortable"
                        data-column="nis">
                        NIS <span class="sort-icon"></span>
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer sortable"
                        data-column="tahun_lulus">
                        Tahun Lulus <span class="sort-icon"></span>
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer sortable"
                        data-column="status">
                        Status <span class="sort-icon"></span>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($alumni as $index => $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->nama }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->nis }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->kelas }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->tahun_lulus }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            @php
                                $statusClass = match (strtoupper($item->status)) {
                                    'AKTIF' => 'bg-green-100 text-green-800',
                                    'ALUMNI' => 'bg-yellow-100 text-yellow-800',
                                    'WIRAUSAHA' => 'bg-purple-100 text-purple-800',
                                    'NON AKTIF' => 'bg-red-100 text-red-800',
                                    default => 'bg-gray-100 text-gray-800',
                                };
                            @endphp
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                {{ $item->status }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">

        
        <div class="text-sm text-gray-700">
            <select id="itemsPerPage" class="px-2 py-1 border border-gray-300 rounded-md w-16 mr-5">
                <option value="10" selected>10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            Menampilkan <span id="showingFrom">1</span> - <span id="showingTo">10</span> dari <span
                id="totalItems">{{ count($alumni) }}</span> alumni
        </div>
        <div class="flex space-x-2">
            <button id="prevPage"
                class="px-3 py-1 border rounded-md text-sm font-medium disabled:opacity-50">Sebelumnya</button>
            <div class="flex space-x-1" id="pageNumbers"></div>
            <button id="nextPage"
                class="px-3 py-1 border rounded-md text-sm font-medium disabled:opacity-50">Berikutnya</button>
        </div>
    </div>
</div>

<style>
    .sort-icon {
        display: inline-block;
        width: 0;
        height: 0;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-bottom: 5px solid #6b7280;
        margin-left: 5px;
        opacity: 0.5;
    }

    .sort-asc .sort-icon {
        border-bottom-color: #3b82f6;
        opacity: 1;
    }

    .sort-desc .sort-icon {
        border-top: 5px solid #3b82f6;
        border-bottom: none;
        opacity: 1;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Data
        const table = document.getElementById('alumniTable');
        const tbody = table.querySelector('tbody');
        const rows = Array.from(tbody.querySelectorAll('tr'));
        let itemsPerPage = 10;
        let currentPage = 1;
        let sortColumn = null;
        let sortDirection = 'asc';
        let filteredRows = rows;

        // Initialize
        updatePagination();
        renderTable();

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            filterRows(searchTerm);
        });

        // Year filter
        document.getElementById('yearFilter').addEventListener('change', function(e) {
            const year = e.target.value;
            filterRows(null, year);
        });

        // Items per page
        document.getElementById('itemsPerPage').addEventListener('change', function(e) {
            itemsPerPage = parseInt(e.target.value, 10);
            currentPage = 1; // Reset to first page
            renderTable();
            updatePagination();
        });



        // Sort functionality
        document.querySelectorAll('.sortable').forEach(header => {
            header.addEventListener('click', function() {
                const column = this.dataset.column;

                // Update sort direction
                if (sortColumn === column) {
                    sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
                } else {
                    sortColumn = column;
                    sortDirection = 'asc';
                }

                // Update UI
                document.querySelectorAll('.sortable').forEach(h => {
                    h.classList.remove('sort-asc', 'sort-desc');
                });
                this.classList.add(sortDirection === 'asc' ? 'sort-asc' : 'sort-desc');

                // Sort and render
                sortRows();
                renderTable();
            });
        });

        // Pagination
        document.getElementById('prevPage').addEventListener('click', function() {
            if (currentPage > 1) {
                currentPage--;
                renderTable();
                updatePagination();
            }
        });

        document.getElementById('nextPage').addEventListener('click', function() {
            if (currentPage < Math.ceil(filteredRows.length / itemsPerPage)) {
                currentPage++;
                renderTable();
                updatePagination();
            }
        });

        // Functions
        function filterRows(searchTerm, yearFilter) {
            filteredRows = rows.filter(row => {
                const cells = row.querySelectorAll('td');
                const nama = cells[1].textContent.toLowerCase();
                const nis = cells[2].textContent.toLowerCase();
                const tahunLulus = cells[4].textContent;

                // Search filter
                const searchMatch = !searchTerm ||
                    nama.includes(searchTerm) ||
                    nis.includes(searchTerm);

                // Year filter
                const yearMatch = !yearFilter || tahunLulus === yearFilter;

                return searchMatch && yearMatch;
            });

            currentPage = 1;
            updatePagination();
            renderTable();
        }

        function sortRows() {
            filteredRows.sort((a, b) => {
                const aValue = a.querySelector(`td:nth-child(${getColumnIndex(sortColumn)})`)
                    .textContent;
                const bValue = b.querySelector(`td:nth-child(${getColumnIndex(sortColumn)})`)
                    .textContent;

                // Numeric comparison for NIS and tahun_lulus
                if (sortColumn === 'nis' || sortColumn === 'tahun_lulus') {
                    const aNum = parseFloat(aValue) || 0;
                    const bNum = parseFloat(bValue) || 0;
                    return sortDirection === 'asc' ? aNum - bNum : bNum - aNum;
                }

                // String comparison for nama
                return sortDirection === 'asc' ?
                    aValue.localeCompare(bValue) :
                    bValue.localeCompare(aValue);
            });
        }

        function getColumnIndex(columnName) {
            const columns = {
                'nama': 2,
                'nis': 3,
                'tahun_lulus': 5
            };
            return columns[columnName] || 2;
        }

        function renderTable() {
            // Clear table
            tbody.innerHTML = '';

            // Calculate pagination
            const start = (currentPage - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            const paginatedRows = filteredRows.slice(start, end);

            // Add rows
            paginatedRows.forEach((row, index) => {
                const newRow = row.cloneNode(true);
                // Update row number
                newRow.querySelector('td:first-child').textContent = start + index + 1;
                tbody.appendChild(newRow);
            });

            // Update showing items
            document.getElementById('showingFrom').textContent = start + 1;
            document.getElementById('showingTo').textContent = Math.min(end, filteredRows.length);
            document.getElementById('totalItems').textContent = filteredRows.length;

            // Update pagination buttons
            document.getElementById('prevPage').disabled = currentPage === 1;
            document.getElementById('nextPage').disabled = currentPage === Math.ceil(filteredRows.length /
                itemsPerPage);
        }

        function updatePagination() {
            const pageNumbers = document.getElementById('pageNumbers');
            pageNumbers.innerHTML = '';

            const totalPages = Math.ceil(filteredRows.length / itemsPerPage);
            const maxPagesToShow = 5;
            let startPage = Math.max(1, currentPage - Math.floor(maxPagesToShow / 2));
            let endPage = Math.min(totalPages, startPage + maxPagesToShow - 1);

            if (endPage - startPage + 1 < maxPagesToShow) {
                startPage = Math.max(1, endPage - maxPagesToShow + 1);
            }

            for (let i = startPage; i <= endPage; i++) {
                const pageBtn = document.createElement('button');
                pageBtn.className =
                    `px-3 py-1 border rounded-md text-sm font-medium ${i === currentPage ? 'bg-blue-50 border-blue-500 text-blue-600' : 'bg-white border-gray-300 text-gray-500'}`;
                pageBtn.textContent = i;
                pageBtn.addEventListener('click', () => {
                    currentPage = i;
                    renderTable();
                    updatePagination();
                });
                pageNumbers.appendChild(pageBtn);
            }
        }
    });
</script>
