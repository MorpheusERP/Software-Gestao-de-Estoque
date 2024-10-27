document.addEventListener('DOMContentLoaded', () => {
    const calendarGrid = document.querySelector('.calendar-grid');
    const monthYear = document.getElementById('month-year');
    const yearDropdown = document.getElementById('year-dropdown');
    const yearSelector = document.getElementById('year-selector');
    const calendarContainer = document.querySelector('.calendar-container');
    const startDateInput = document.getElementById('start-date');
    const endDateInput = document.getElementById('end-date');

    let currentDate = new Date();
    let currentYear = currentDate.getFullYear();
    let currentMonth = currentDate.getMonth();
    let startDate = null;
    let endDate = null;

    // Função para gerar os anos de 2000 até 2040 no seletor de ano
    function populateYearSelector() {
        for (let year = 2000; year <= 2040; year++) {
            const yearOption = document.createElement('div');
            yearOption.classList.add('year-option');
            yearOption.setAttribute('data-year', year);
            yearOption.textContent = year;

            // Adiciona um evento de clique para selecionar o ano
            yearOption.addEventListener('click', () => {
                currentYear = parseInt(yearOption.getAttribute('data-year'), 10);
                currentDate = new Date(currentYear, currentMonth, 1);
                renderCalendar();
                yearSelector.style.display = 'none';
            });

            yearSelector.appendChild(yearOption);
        }
    }

    // Função para renderizar o calendário
    function renderCalendar() {
        calendarGrid.innerHTML = `
            <div class="day-name">Seg</div>
            <div class="day-name">Ter</div>
            <div class="day-name">Qua</div>
            <div class="day-name">Qui</div>
            <div class="day-name">Sex</div>
            <div class="day-name">Sáb</div>
            <div class="day-name">Dom</div>
        `;
        monthYear.textContent = `${currentDate.toLocaleString('default', { month: 'long' })} ${currentYear}`;
        
        const firstDayOfMonth = new Date(currentYear, currentMonth, 1);
        const lastDayOfMonth = new Date(currentYear, currentMonth + 1, 0);
        let startDay = firstDayOfMonth.getDay();
        
        startDay = (startDay === 0) ? 6 : startDay - 1;

        for (let i = 0; i < startDay; i++) {
            const emptyDiv = document.createElement('div');
            calendarGrid.appendChild(emptyDiv);
        }

        for (let day = 1; day <= lastDayOfMonth.getDate(); day++) {
            const dayDiv = document.createElement('div');
            dayDiv.textContent = day;

            const currentDateCheck = new Date(currentYear, currentMonth, day);
            if (startDate && datesAreEqual(currentDateCheck, startDate)) {
                dayDiv.classList.add('start-date');
            }
            if (endDate && datesAreEqual(currentDateCheck, endDate)) {
                dayDiv.classList.add('end-date');
            }
            if (startDate && endDate && currentDateCheck > startDate && currentDateCheck < endDate) {
                dayDiv.classList.add('selected');
            }

            dayDiv.addEventListener('click', () => {
                handleDateSelection(new Date(currentYear, currentMonth, day));
                renderCalendar();
            });

            calendarGrid.appendChild(dayDiv);
        }
    }

    // Função para verificar se duas datas são iguais (ignora horário)
    function datesAreEqual(date1, date2) {
        return date1.getFullYear() === date2.getFullYear() &&
               date1.getMonth() === date2.getMonth() &&
               date1.getDate() === date2.getDate();
    }

    // Função para lidar com a seleção de datas
    function handleDateSelection(selectedDate) {
        if (!startDate || (startDate && endDate)) {
            startDate = selectedDate;
            endDate = null;
        } else if (selectedDate < startDate) {
            endDate = startDate;
            startDate = selectedDate;
        } else if (!endDate && selectedDate > startDate) {
            endDate = selectedDate;
        } else {
            startDate = selectedDate;
            endDate = null;
        }

        // Atualiza as caixas de entrada com as datas selecionadas
        startDateInput.value = startDate ? startDate.toLocaleDateString() : '';
        endDateInput.value = endDate ? endDate.toLocaleDateString() : '';
    }

    // Evento para navegar para o mês anterior
    document.getElementById('prev-month').addEventListener('click', () => {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
            currentDate = new Date(currentYear, currentMonth, 1);
        } else {
            currentDate = new Date(currentYear, currentMonth, 1);
        }
        renderCalendar();
    });

    // Evento para navegar para o próximo mês
    document.getElementById('next-month').addEventListener('click', () => {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
            currentDate = new Date(currentYear, currentMonth, 1);
        } else {
            currentDate = new Date(currentYear, currentMonth, 1);
        }
        renderCalendar();
    });

    // Evento para mostrar o seletor de ano
    yearDropdown.addEventListener('click', () => {
        yearSelector.style.display = yearSelector.style.display === 'none' ? 'block' : 'none';
    });

    // Evento para mostrar o calendário ao clicar nas caixas de data
    startDateInput.addEventListener('click', () => {
        calendarContainer.style.display = 'block';
        renderCalendar();
    });

    endDateInput.addEventListener('click', () => {
        calendarContainer.style.display = 'block';
        renderCalendar();
    });

    // Evento de cancelamento
    document.getElementById('cancel').addEventListener('click', () => {
        startDate = null;
        endDate = null;
        startDateInput.value = '';
        endDateInput.value = '';
        calendarContainer.style.display = 'none';
    });

    // Evento para o botão OK (sem notificação)
    document.getElementById('ok').addEventListener('click', () => {
        calendarContainer.style.display = 'none';
    });

    // Inicializa o seletor de ano
    populateYearSelector();
    renderCalendar();
});
