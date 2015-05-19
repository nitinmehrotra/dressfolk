<?php

    class Common_model extends CI_Model
    {

        public function __construct()
        {
            parent::__construct();
            // Load DB here
            $this->load->database();
        }

        public function fetchRecords($tableName)
        {
            $result = $this->db->get($tableName);
            return $result->result_array();
        }

        public function insertData($tablename, $data_array)
        {
            $this->db->insert($tablename, $data_array);
        }

        public function updateData($tablename, $data_array, $whereCondArr)
        {
            $this->db->update($tablename, $data_array, $whereCondArr);
        }

        public function deleteData($tablename, $whereCondArr)
        {
            $this->db->delete($tablename, $whereCondArr);
        }

        public function fetchSelectedData($fields, $tablename, $whereCondArr = null, $orderbyFieldName = NULL, $orderbyType = "ASC", $limit = NULL)
        {
            if ($limit != NULL)
                $this->db->limit($limit);

            if ($orderbyFieldName == NULL)
            {
                $records = $this->db->select($fields);
            }
            else
            {

                $records = $this->db->select($fields)
                        ->order_by($orderbyFieldName, $orderbyType);
            }

            if ($whereCondArr != NULL)
                $records = $records->get_where($tablename, $whereCondArr);
            else
                $records = $records->get($tablename);
            $records = $records->result_array();
            return $records;
        }

        public function getAllData($fields, $tableName, $orderByFieldName = NULL, $orderByType = NULL)
        {
            if ($orderByType == NULL)
                $orderByType = "asc";

            if ($orderByFieldName != NULL)
            {
                $records = $this->db->select($fields)
                        ->order_by($orderByFieldName, $orderByType)
                        ->get($tableName)
                        ->result_array();
            }
            else
            {
                $records = $this->db->select($fields)
                        ->get($tableName)
                        ->result_array();
            }

            return $records;
        }

        public function getAllDataFromJoin($fields, $tableName, $tableArrayWithJoinCondition, $joinType = "INNER", $whereCondArr = null, $orderByFieldName = NULL, $orderByType = NULL)
        {
            if ($orderByType == NULL)
                $orderByType = "asc";

            if ($orderByFieldName != NULL)
            {
                $records = $this->db->select($fields)
                        ->order_by($orderByFieldName, $orderByType);
            }
            else
            {
                $records = $this->db->select($fields);
            }

            foreach ($tableArrayWithJoinCondition as $joinTableName => $joinCondition)
            {
                $records = $records->join($joinTableName, $joinCondition, $joinType);
            }

            if ($whereCondArr != NULL)
                $records = $records->get_where($tableName, $whereCondArr);
            else
                $records = $records->get($tableName);
            $records = $records->result_array();

            return $records;
        }

        public function getMaxId($fieldName, $tableName)
        {
            $records = $this->db->select("max($fieldName) as maxid")
                    ->get($tableName)
                    ->result_array();
            return $records;
        }

        public function getTotalCount($fieldName, $tableName, $whereCondArr = NULL)
        {
            $records = $this->db->select("COUNT($fieldName) as totalcount");
            if ($whereCondArr == NULL)
                $records = $records->get($tableName);
            else
                $records = $records->get_where($tableName, $whereCondArr);
            $records = $records->result_array();
            return $records;
        }

        public function getTotalSum($fieldName, $tableName, $whereCondArr = NULL)
        {
            $records = $this->db->select("SUM($fieldName) as totalsum");
            if ($whereCondArr == NULL)
                $records = $records->get($tableName);
            else
                $records = $records->get_where($tableName, $whereCondArr);
            $records = $records->result_array();
            return $records;
        }

        public function is_exists($fields, $tableName, $whereCondArr = NULL)
        {
            if ($whereCondArr != NULL)
            {
                $records = $this->db->select($fields)
                        ->get_where($tableName, $whereCondArr)
                        ->result_array();
            }
            else
            {
                $records = $this->db->select($fields)
                        ->get($tableName)
                        ->result_array();
            }
            return $records;
        }

    }

    