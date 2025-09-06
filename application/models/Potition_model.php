<?php
class Potition_model extends CI_Model
{
    public function getAll()
    {
        return $this->db->get('potition')->result_array();
    }

    public function getById($id)
    {
        return $this->db->get_where('potition', ['id' => $id])->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('potition', $data);
    }

    public function update($id, $data)
    {
        return $this->db->update('potition', $data, ['id' => $id]);
    }

    public function delete($id)
    {
        return $this->db->delete('potition', ['id' => $id]);
    }
}
