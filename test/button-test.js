require('dotenv').config();

const { Selector } = require('testcafe');

fixture`Button Click Test`
    .page`${process.env.TEST_URL}`;

test('Click the button', async t => {
    const button = Selector('#click-button');

    await t
        .expect(button.exists).ok('Button with id "click-button" should exist')
        .click(button);
});