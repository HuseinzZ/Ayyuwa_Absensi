<?php
class Position_model extends CI_Model
{
    public function getAll()
    {
        // Mengambil semua data posisi.
        return $this->db->get('position')->result_array();
    }

    public function getById($id)
    {
        // Mengambil data posisi berdasarkan ID.
        return $this->db->get_where('position', ['id' => $id])->row_array();
    }

    public function insert($data)
    {
        // Menambahkan data posisi baru.
        return $this->db->insert('position', $data);
    }

    public function update($id, $data)
    {
        // Memperbarui data posisi berdasarkan ID.
        return $this->db->update('position', $data, ['id' => $id]);
    }

    public function delete($id)
    {
        // Menghapus data posisi berdasarkan ID.
        return $this->db->delete('position', ['id' => $id]);
    }
}
