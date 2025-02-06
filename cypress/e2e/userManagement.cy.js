describe('Gestion des utilisateurs', () => {
  beforeEach(() => {
      cy.visit('http://localhost/gestion_produit/src/');
  });

  it('Ajoute un utilisateur', () => {
      cy.get('#name').type('Test User');
      cy.get('#email').type('testuser@example.com');
      cy.get('button[type="submit"]').click();
      
      cy.wait(1000);
      cy.get('#userList').contains('Test User');
  });

  it('Modifie un utilisateur', () => {
      cy.contains('Test User').parent().find('button').first().click();
      cy.get('#name').clear().type('Updated User');
      cy.get('#email').clear().type('updated@example.com');
      cy.get('button[type="submit"]').click();
      
      cy.wait(1000);
      cy.get('#userList').contains('Updated User');
  });

  it('Supprime un utilisateur', () => {
      cy.contains('Updated User').parent().find('button').last().click();
      
      cy.wait(1000);
      cy.get('#userList').should('not.contain', 'Updated User');
  });
});
