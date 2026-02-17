# GitHub Configuration for SomaTech Portfolio

This directory contains GitHub-specific configuration files for the SomaTech Portfolio Website project.

## Files Overview

### Workflows
- **`.github/workflows/ci.yml`** - Continuous Integration pipeline that runs on every push and pull request
  - Runs tests on PHP 8.2 and 8.3
  - Executes Laravel Pint for code formatting checks
  - Builds frontend assets to verify compilation
  - Automatically runs on branches: `main`, `develop`, and `abrar`

### Templates
- **`PULL_REQUEST_TEMPLATE.md`** - Template for pull requests with SRS reference, checklist, and testing guidelines
- **`ISSUE_TEMPLATE/bug_report.md`** - Template for reporting bugs with environment details
- **`ISSUE_TEMPLATE/feature_request.md`** - Template for feature requests aligned with SRS requirements

### Configuration
- **`CODEOWNERS`** - Defines code ownership for automatic review assignments (@Abrar1968 as global owner)
- **`dependabot.yml`** - Automated dependency updates for Composer, npm, and GitHub Actions

## CI Pipeline

The CI pipeline runs automatically on:
- Push to `main`, `develop`, or `abrar` branches
- Pull requests targeting `main` or `develop`

### Test Job
- Sets up PHP environment with required extensions
- Installs Composer dependencies
- Runs Laravel Pint to ensure code formatting standards
- Executes the full test suite

### Build Job
- Sets up Node.js 20
- Installs npm dependencies
- Builds production assets using Vite

## Dependabot

Dependabot is configured to automatically:
- Check for Composer package updates weekly
- Check for npm package updates weekly
- Check for GitHub Actions updates weekly
- Create PRs with up to 5 updates at a time
- Tag updates appropriately and assign to @Abrar1968

## Usage

All templates will be automatically presented when:
- Creating a new pull request
- Creating a new issue (with type selection)

The CI pipeline runs automatically and requires no manual intervention.
