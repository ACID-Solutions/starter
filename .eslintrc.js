module.exports = {
    'env': {
        'browser': true,
        'commonjs': true,
        'es2021': true
    },
    'extends': 'eslint:recommended',
    'parserOptions': {
        'ecmaVersion': 12,
        'sourceType': 'module'
    },
    'globals': {
        'app': true,
        'Swal': true,
        '$': true
    },
    'rules': {
        'max-len': [2, 120],
        'indent': [2, 4],
        'no-tabs': 1,
        'quotes': [2, 'single', {'avoidEscape': true, 'allowTemplateLiterals': true}]
    }
};
