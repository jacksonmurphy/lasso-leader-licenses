# Lasso Leader License Database

This private repository manages license validation for the Lasso Leader WordPress plugin.

## Repository Structure

lasso-leader-licenses/
├── licenses/           # License validation files
├── scripts/           # License generation scripts
├── config.json       # Repository configuration
└── README.md         # This file

## Security Notice

🔒 **This is a private repository** containing license validation data for the Lasso Leader plugin.

- Never make this repository public
- Limit access to authorized personnel only
- License files contain client information
- GitHub token required for API access

## Usage

### Generating Licenses
1. Run `scripts/generate-license.php` locally
2. Create license files in `licenses/` directory
3. Provide license keys to authorized users

### Revoking Licenses
1. Delete corresponding license file from `licenses/`
2. Commit changes to repository
3. License will be invalid on next validation

## Contact

For license management questions, contact Jackson Murphy.
