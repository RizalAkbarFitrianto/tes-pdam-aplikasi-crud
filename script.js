$(document).ready(function () {
    loadEmployees();
    loadRooms();

    $('#employeeForm').on('submit', function (e) {
        e.preventDefault();

        let nip = $('#nip').val();
        let employeeData = {
            nama: $('#nama').val(),
            alamat: $('#alamat').val(),
            tgl_lahir: $('#tgl_lahir').val(),
            id_ruangan: $('#id_ruangan').val()
        };

        if (nip) {
            employeeData.nip = nip;
        }

        $.ajax({
            url: 'save_pegawai.php',
            type: 'POST',
            data: JSON.stringify(employeeData),
            success: function (response) {
                alert(response.message);
                loadEmployees();
                $('#employeeForm')[0].reset();
            }
        });
    });

    $('#employeeTable').on('click', '.edit-btn', function () {
        let nip = $(this).data('nip');
        $.getJSON(`get_pegawai.php?nip=${nip}`, function (data) {
            $('#nip').val(data.nip);
            $('#nama').val(data.nama);
            $('#alamat').val(data.alamat);
            $('#tgl_lahir').val(data.tgl_lahir);
            $('#id_ruangan').val(data.id_ruangan);
        });
    });

    $('#employeeTable').on('click', '.delete-btn', function () {
        let nip = $(this).data('nip');
        $.ajax({
            url: 'delete_pegawai.php',
            type: 'POST',
            data: JSON.stringify({
                nip: nip
            }),
            success: function (response) {
                alert(response.message);
                loadEmployees();
            }
        });
    });

    function loadEmployees() {
        $.getJSON('get_pegawai.php', function (data) {
            let rows = '';
            data.forEach(function (employee) {
                rows += `
                    <tr>
                        <td>${employee.nip}</td>
                        <td>${employee.nama}</td>
                        <td>${employee.alamat}</td>
                        <td>${employee.tgl_lahir}</td>
                        <td>${employee.id_ruangan}</td>
                        <td>
                            <button class="btn btn-primary edit-btn" data-nip="${employee.nip}">Edit</button>
                            <button class="btn btn-danger delete-btn" data-nip="${employee.nip}">Hapus</button>
                        </td>
                    </tr>
                `;
            });
            $('#employeeTable').html(rows);
        });
    }

    function loadRooms() {
        $.getJSON('get_rooms.php', function (data) {
            let options = '<option value="">-Pilih data-</option>';
            data.forEach(function (room) {
                options += `<option value="${room.id_ruangan}">${room.keterangan}</option>`;
            });
            $('#id_ruangan').html(options);
        });
    }

    function deleteEmployee(nip) {
        $.ajax({
            url: 'delete_pegawai.php',
            type: 'GET',
            data: {
                nip: nip
            }, // NIP is passed here
            success: function (response) {
                alert(response.message);
                loadEmployees(); // Refresh the employee list
            },
            error: function () {
                alert('Failed to delete the employee');
            }
        });
    }

});