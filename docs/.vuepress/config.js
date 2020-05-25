module.exports = {
    title: 'PHP Checkup',
    description: 'Framework agnostic application health and requirement checks.',
    themeConfig: {
        nav: [
            { text: 'GitHub', link: 'https://github.com/gerardojbaez/php-checkup' }
        ],
        sidebar: [
            {
                title: 'Getting Started',
                collapsable: false,
                children: [
                    'getting-started/introduction',
                    'getting-started/installation'
                ]
            },
            {
                title: 'Usage',
                collapsable: false,
                children: [
                    'usage/check-list',
                    'usage/create-checks',
                    'usage/builtin-checks'
                ]
            }
        ]
    }
}
