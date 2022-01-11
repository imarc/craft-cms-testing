describe('Contact Us', () => {
    beforeEach(() => {
        cy.visit('/company/contact-us')
    })

    it('Test the sales rep form', () => {
        // https://on.cypress.io/submit
        cy.get('form.rep-lookup')
            .find('select')
            .select('Fire Protection')

        cy.get('form.rep-lookup')
            .find('input[name=zipCode]')
            .type('01913')

        cy.get('form.rep-lookup').submit()

        cy.get('section.lookup').should('contain', 'Fire Protection Solution for 01913')
    })

    it('Test the contact form', () => {
        cy.get('form[action="#email"]')
            .find('select#contactFormTopic')
            .select('Customer Service')

        cy.get('form[action="#email"]')
            .find('select#contactFormProductLine')
            .select('Flow Control')

        cy.get('form[action="#email"]')
            .find('input#contactFormFirstName')
            .type('Homer')

        cy.get('form[action="#email"]')
            .find('input#contactFormLastName')
            .type('Simpson')

        cy.get('form[action="#email"]')
            .find('input#contactFormEmail')
            .type('test@imarc.com')

        cy.get('form[action="#email"]')
            .find('input#contactFormCompany')
            .type('Imarc')

        cy.get('form[action="#email"]')
            .find('input#contactFormAddress')
            .type('21 Water St')

        cy.get('form[action="#email"]')
            .find('input#contactFormCity')
            .type('Amesbury')

        cy.get('form[action="#email"]')
            .find('select#contactFormState')
            .select('Massachusetts')

        cy.get('form[action="#email"]')
            .find('input#contactFormZipCode')
            .type('01913')

        cy.get('form[action="#email"]')
            .find('select#contactFormCountrySelect')
            .select('United States')
            
        // can't set recaptcha on local site, so this submission should fail
        cy.get('form[action="#email"]').submit()

        cy.get('.error').contains('Unable to validate form submission')
    })
})