describe('Navigation', () => {
    beforeEach(() => {
        cy.visit('/')
    })

    it('Test the header logo home link', () => {
        cy.visit('/products')

        cy.get('div.branding a').click()
        cy.location('pathname').should('not.include', 'products')
    })

    it('Testing primary nav dropdown', () => {
        cy.viewport(1200, 1600)
        cy.get('nav.primary').should('be.visible')

        cy.get('nav.primary').contains('Products & Services').click()
        cy.location('pathname').should('include', 'products')

        cy.get('nav.primary').contains('Solutions').click()
        cy.location('pathname').should('include', 'solutions')

        cy.get('nav.primary').contains('Resources').click()
        cy.location('pathname').should('include', 'resources-and-downloads')

        cy.get('nav.primary').contains('Design Tools').click()
        cy.location('pathname').should('include', 'tools')

        cy.get('nav.primary').contains('Company').click()
        cy.location('pathname').should('include', 'company')
    })

    it('Testing mobile nav dropdown', () => {
        cy.viewport(600, 800)
        cy.get('div.toggle').should('be.visible')

        cy.get('button.menu-toggle').click()
        cy.get('nav#mobile').contains('Products & Services').click()
        cy.get('a').contains('Pipe Joining Systems').click()
        cy.location('pathname').should('include', 'products')

        cy.get('button.menu-toggle').click()
        cy.get('nav#mobile').contains('Solutions').click()
        cy.get('a').contains('Industrial').click()
        cy.location('pathname').should('include', 'industrial')

        cy.get('button.menu-toggle').click()
        cy.get('nav#mobile').contains('Resources').click()
        cy.get('a').contains('Datasheets').click()
        cy.location('pathname').should('include', 'resources-and-downloads')

        cy.get('button.menu-toggle').click()
        cy.get('nav#mobile').contains('Design Tools').click()
        cy.get('a').contains('ASC Tools').click()
        cy.location('pathname').should('include', 'tools')

        cy.get('button.menu-toggle').click()
        cy.get('nav#mobile').contains('Company').click()
        cy.get('a').contains('Locations').click()
        cy.location('pathname').should('include', 'locations')
    })

    it('Testing utility nav', () => {
        cy.viewport(1200, 1600)
        cy.get('nav.utility').should('be.visible')

        cy.get('nav.utility').contains('Contact Us').click()
        cy.location('pathname').should('include', 'contact-us')

        cy.get('nav.utility').contains('Price Sheets').click()
        cy.location('pathname').should('include', 'price-sheets')

        cy.get('nav.utility').contains('Careers').click()
        cy.location('pathname').should('include', 'careers')

        cy.get('nav.utility').contains('Customer Login').click()
        cy.location('pathname').should('include', 'login')
    })

    it('Testing footer nav', () => {
        cy.viewport(1200, 1600)
        cy.get('nav.footer').should('be.visible')

        cy.get('nav.utility').contains('Contact Us').click()
        cy.location('pathname').should('include', 'contact-us')

        cy.get('nav.primary').contains('Products & Services').click()
        cy.location('pathname').should('include', 'products')

        cy.get('nav.primary').contains('Solutions').click()
        cy.location('pathname').should('include', 'solutions')

        cy.get('nav.primary').contains('Resources').click()
        cy.location('pathname').should('include', 'resources-and-downloads')

        cy.get('nav.primary').contains('Design Tools').click()
        cy.location('pathname').should('include', 'tools')

        cy.get('nav.primary').contains('Company').click()
        cy.location('pathname').should('include', 'company')

        cy.get('footer div.legal').contains('Privacy Policy').click()
        cy.location('pathname').should('include', 'privacy-policy')

        cy.get('footer div.legal').contains('Terms & Conditions').click()
        cy.location('pathname').should('include', 'terms-conditions')
    })
})