describe('Accounts', () => {
    it('Test Login/Logout', () => {
        cy.login(Cypress.env('CYPRESS_LOGIN_NAME'), Cypress.env('CYPRESS_LOGIN_PASSWORD'))

        cy.get('a.customerLogin').should('contain', 'Log Out')
        cy.get('a.customerLogin').click()
        cy.get('a.customerLogin').should('contain', 'Customer Login')
    })

    it('Test Forgot Password', () => {
        cy.visit('/account/forgot-password')

        cy.get('main .container form')
            .find('input[name=loginName]')
            .type('bill@imarc.com')
          
        cy.get('main .container form').submit()

        cy.get('.success').should('contain', 'A link to update your password was sent to your email address')
    })

    it('Test Registration', () => {
        cy.visit('/account/register')

        cy.get('main form #loginName').type('bill@imarc.com')
        cy.get('main form #password').type('1234-4321')
        cy.get('main form #firstName').type('Cypress')
        cy.get('main form #lastName').type('Tester')          
        cy.get('main form #userJobTitle').type('Website Tester')
        cy.get('main form #userCompany').type('Imarc')          
        cy.get('main form #userAddress1').type('21 Water St')          
        cy.get('main form #userCity').type('Amesbury')
        cy.get('main form #userState').select('Massachusetts')
        cy.get('main form #country').select('United States')
        cy.get('main form #userZip').type('01913')

        // Email should match an existing user so submitting the form should generate an error
        cy.get('main .container form').submit()

        cy.get('.error').should('contain', 'Email "bill@imarc.com" has already been taken')
    })
})