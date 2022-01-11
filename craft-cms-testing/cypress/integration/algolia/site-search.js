describe('Site Search', () => {
    beforeEach(() => {
        cy.visit('https://asc-es.imarc.io')
    })

    it('Test site search', () => {
        cy.get('#search')
            .find('input[type=search]')
            .type('1101')

        cy.get('#search .results').should('contain', '1101 90° Elbow')
    })
})