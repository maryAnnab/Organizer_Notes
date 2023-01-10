<?php 

declare(strict_types=1);

namespace App;

use App\Exception\ConfigurationException;
use App\Exception\StorageException;
use App\Exception\NotFoundException;
use PDO;
use PDOException;
use Throwable;

class Database
{
  private PDO $conn;

  public function __construct(array $config)
  {
    try {
      $this->validateConfig($config);
      $this->createConnection($config);
    } catch (PDOException $e) {
      throw new StorageException('Connection error');
    }
  }

  public function getNote(int $id): array
  {
    try {
      $query = "SELECT * FROM notes WHERE id = $id";
      $result = $this->conn->query($query);
      $note = $result->fetch(PDO::FETCH_ASSOC);
    } catch (Throwable $e) {
      throw new StorageException('The note could not be downloaded', 400, $e);
    }

    if (!$note) {
      throw new NotFoundException("Note about id: $id is not exist");
    }


    return $note;
  }

  public function getNotes(string $sortBy, string $sortOrder): array
  {
     try {
      if (!in_array($sortBy, ['created', 'title'])) {
         $sortBy = 'title'; 
      }

      if (!in_array($sortOrder, ['asc', 'desc'])) {
        $sortBy = 'desc'; 
     }


      $query = "
        SELECT id, title, created 
        FROM notes
        ORDER BY $sortBy $sortOrder
        ";

      $result = $this->conn->query($query);
      return $result->fetchAll(PDO::FETCH_ASSOC);
     } catch (Throwable $e) {
       throw new StorageException('Failed to fetch note data', 400, $e);
     }
  } 

  public function createNote(array $data): void
  {
    try {
      $title = $this->conn->quote($data['title']);
      $description = $this->conn->quote($data['description']);
      $created = $this->conn->quote(date('Y-m-d H:i:s'));

      $query = "
        INSERT INTO notes(title, description, created) 
        VALUES($title, $description, $created)
      ";

      $this->conn->exec($query);
    } catch (Throwable $e) {
      throw new StorageException('Failed to create new note', 400, $e);
    }
  }

  public function editNote(int $id, array $data): void
  {
    try {
      $title = $this->conn->quote($data['title']);
      $description = $this->conn->quote($data['description']);

      $query = "
       UPDATE notes
       SET title = $title, description = $description
       WHERE id = $id
      ";
      
      $this->conn->exec($query);
    } catch (Throwable $e) {
      throw new StorageException('Failed to edit note', 400, $e);
    }
  }

  public function deleteNote(int $id): void
  {
    try {
      $query = "DELETE FROM notes WHERE id = $id LIMIT 1";
      $this->conn->exec($query);
    } catch (Throwable $e) {
      throw new StorageException('Failed to delete note', 400, $e);
    }
  }

  private function createConnection(array $config): void
  {
    $dsn = "mysql:dbname={$config['database']};host={$config['host']}";
    $this->conn = new PDO(
      $dsn,
      $config['user'],
      $config['password'],
      [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      ]
   );
  }

  private function validateConfig(array $config): void
  {
    if (
      empty($config['database']) 
      || empty($config['host']) 
      || empty($config['user']) 
      || empty($config['password']) 
    ) {
      throw new ConfigurationException('Storage configuration error');
    }
  } 

}