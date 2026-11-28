---
title: Conversion Tracking: How to See What Your Ads Actually Bring In
meta_description: Paying for Google and Meta ads without knowing what works? What conversion tracking is, how to set it up, and how to stop paying for ads that don't sell.
slug: conversion-tracking
primary_keyword: conversion tracking
secondary_keywords: Google Ads conversion tracking, Meta Pixel, Conversions API, enhanced conversions, cost per lead
type: Problem & solution
service_link: services.php#campaigns
image_alt: Conversion tracking report: inquiries by source, Google, Instagram, Facebook and organic
topic: campaigns
published: 2026-11-28
---

# Conversion Tracking: How to See What Your Ads Actually Bring In

"I spend money on ads every month and I have no idea what's working." If that sounds familiar, you're not alone. Your ad dashboards show clicks, impressions and likes, but the question that matters stays unanswered: **how many customers did this bring in, and what did each one cost?**

The answer starts with one thing: **conversion tracking.**

## What is conversion tracking?

A conversion is the action that actually matters to your business: a form submitted, a WhatsApp or phone tap, a call, a purchase. Conversion tracking counts each of those actions and records which campaign, ad and keyword it came from.

Without it, Google and Meta can only tell you how many people clicked. With it, you see how many of them became inquiries, and your real cost per lead.

## Why conversion tracking matters

1. **You know where to put your money.** If campaign A brings in leads cheaply and campaign B brings in nothing, the decision makes itself.
2. **The ad platforms learn.** When Google and Meta know what a conversion looks like, their bidding looks for more people like the ones who converted. Without tracking, they optimize for people who click, which isn't the same thing.
3. **You stop guessing.** Budget, ad and audience decisions are made on numbers instead of gut feeling.

## What to measure

Not every action is a conversion. Focus on what leads directly to a customer:

- **A form submission** on your website or landing page.
- **A tap on WhatsApp or your phone number.**
- **A purchase** in an online store, including its value.
- **A booked appointment,** if you use a booking system.

## How to set up conversion tracking properly

1. **Install the tags:** the Google tag for Google Ads conversion tracking, and the Meta Pixel for Facebook and Instagram ads.
2. **Define events:** each action above is sent as its own event, with a clear name.
3. **Connect them to your campaigns:** mark in Google Ads and in Meta Events Manager which events count as conversions.
4. **Add server-side signals:** Meta's Conversions API sends events from your server or CRM, and Google's enhanced conversions sends hashed first-party data such as an email address. Both help count conversions that browser tags miss.
5. **Test that it works:** submit the form yourself and confirm the conversion shows up. This is the step most often skipped, and it's exactly where bad data comes from.
6. **Connect it to your CRM (advanced):** then you see not only which campaign brought in a lead, but which one brought in a customer who actually paid.

## Common mistakes

- **Double counting:** the same conversion is recorded twice, so the campaign looks better than it is.
- **Measuring the wrong thing:** a page view counted as a conversion instead of a real inquiry.
- **Tracking that breaks silently:** a website change removes the tag and nobody notices for months.
- **No link to business results:** you know how many leads came in, but not how many became customers.

## What comes after measurement

Now the real optimization starts: put more budget behind what brings inquiries at a good cost, pause what doesn't, and test new ads and audiences against real numbers. At the end of each month you should have a simple report: how much you spent, how many inquiries came in, and what changes next month.

Even the best campaign won't help if the [landing page](landing-page) doesn't convert, or if [leads don't get a reply in time](stop-losing-leads).

## Sources

- [About conversion measurement (Google Ads Help)](https://support.google.com/google-ads/answer/1722022)
- [About enhanced conversions (Google Ads Help)](https://support.google.com/google-ads/answer/9888656)
- [Meta Pixel (Meta for Developers)](https://developers.facebook.com/docs/meta-pixel)
- [Conversions API (Meta for Developers)](https://developers.facebook.com/docs/marketing-api/conversions-api)

## Frequently asked questions

**Is conversion tracking worth it on a small ad budget?**
Especially then. With a small budget, every dollar spent on an ad that doesn't work hurts more.

**Can I track WhatsApp and phone taps?**
Yes. A tap on a WhatsApp or call button on your site is counted as an event and tied to the campaign, just like a form.

**I already have a Meta Pixel on my site. Isn't that enough?**
Not necessarily. An installed pixel is only the start. You need to check that the right events are set up and that they're actually being counted.

---

**Want to know what's really working in your ads?** Tell me where you advertise today and what you measure. [More about paid ads](services.php#campaigns).
