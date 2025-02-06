<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__.'./../src/UserManager.php';

class UserManagerTest extends TestCase {
    private UserManager $userManager;

    protected function setUp(): void {
        $this->userManager = new UserManager();
    }

    public function testAddUser() {
        $this->userManager->addUser("John Doe", "john.doe@example.com");
        $users = $this->userManager->getUsers();
        $this->assertNotEmpty($users);
    }

    public function testAddUserEmailException() {
        $this->expectException(InvalidArgumentException::class);
        $this->userManager->addUser("Jane Doe", "email-invalide");
    }

    public function testUpdateUser() {
        $users = $this->userManager->getUsers();
        $userId = $users[0]['id'] ?? null;
        $this->assertNotNull($userId);

        $this->userManager->updateUser($userId, "Jane Doe", "jane.doe@example.com");
        $updatedUser = $this->userManager->getUser($userId);
        $this->assertEquals("Jane Doe", $updatedUser['name']);
    }

    public function testRemoveUser() {
        $users = $this->userManager->getUsers();
        $userId = $users[0]['id'] ?? null;
        $this->assertNotNull($userId);

        $this->userManager->removeUser($userId);
        $usersAfter = $this->userManager->getUsers();
        $this->assertCount(0, $usersAfter);
    }

    public function testGetUsers() {
        $this->userManager->addUser("Alice", "alice@example.com");
        $users = $this->userManager->getUsers();
        $this->assertGreaterThanOrEqual(1, count($users));
    }

    public function testInvalidUpdateThrowsException() {
        $this->expectException(Exception::class);
        $this->userManager->updateUser(9999, "Test", "test@example.com");
    }

    public function testInvalidDeleteThrowsException() {
        $this->expectException(Exception::class);
        $this->userManager->removeUser(9999);
    }
}
?>
