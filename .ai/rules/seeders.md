---
paths:
  - database/seeders/CaseStudySeeder.php
---

# Seeders

## Pin seeded case-study slugs after updates
Spatie sluggable regenerates CaseStudy slugs when seeded titles are updated. Match presentation projects by title, then force the approved slug with saveQuietly() so repeated seeding stays idempotent and public project URLs remain stable.
